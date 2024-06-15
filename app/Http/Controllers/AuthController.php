<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Mail\VerifiedMail;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Validator;


class AuthController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login', 'login_tienda', 'register', 'verified_auth', 
    'verified_email', 'verified_code', 'new_password']]);
  }

  public function register()
  {
    $validator = Validator::make(request()->all(), [
      'name' => 'required',
      'surname' => 'required',
      'phone' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors()->toJson(), 400);
    }

    $user = new User;
    $user->name = request()->name;
    $user->surname = request()->surname;
    $user->phone = request()->phone;
    $user->type_user = 2;
    $user->email = request()->email;
    $user->uniqd = uniqid();
    $user->password = bcrypt(request()->password);
    $user->save();

    Mail::to(request()->email)->send(new VerifiedMail($user));

    return response()->json($user, 201);
  }

  public function update(Request $request) {
    if($request->passowrd){
        $user = User::find(auth("api")->user()->id);
        $user->update([
            "password" => bcrypt($request->password)
        ]);
        return response()->json([
            "message" => 200,
        ]);
    }
    $is_exists_email = User::where("id","<>",auth("api")->user()->id)
                                ->where("email",$request->email)->first();
    if($is_exists_email){
        return response()->json([
            "message" => 403,
            "message_text" => "El usuario ya existe"
        ]);
    }
    $user = User::find(auth("api")->user()->id);
    if($request->hasFile("file_imagen")){
        if($user->avatar){
            Storage::delete($user->avatar);
        }
        $path = Storage::putFile("users",$request->file("file_imagen"));
        $request->request->add(["avatar" => $path]);
    }
    $user->update($request->all());
    return response()->json([
        "message" => 200,
    ]);
}

  public function verified_email(Request $request)
  {
    $user = User::where("email", $request->email)->first();
    if ($user) {
      $user->update(["code_verified" => uniqid()]);
      Mail::to($request->email)->send(new ForgotPasswordMail($user));
      return response()->json(["message" => 200]);
    } else {
      return response()->json(["message" => 403]);
    }
  }
  public function verified_code(Request $request)
  {
    $user = User::where("code_verified", $request->code)->first();
    if ($user) {
      return response()->json(["message" => 200]);
    } else {
      return response()->json(["message" => 403]);
    }
  }
  public function new_password(Request $request)
  {
    $user = User::where("code_verified", $request->code)->first();
    $user->update(["password" => bcrypt($request->new_password), "code_verified" => null]);
    return response()->json(["message" => 200]);
  }

  public function login()
  {
    $credentials = request(['email', 'password']);
    if (
      !$token = auth('api')->attempt([
        "email" => request()->email,
        "password" => request()->password,
        "type_user" => 1
      ])
    ) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }

  public function login_tienda()
  {
    $credentials = request(['email', 'password']);

    if (
      !$token = auth('api')->attempt([
        "email" => request()->email,
        "password" => request()->password,
        "type_user" => 2
      ])
    ) {
      return response()->json(['error' => 'Unauthorizedere'], 401);
    }

    if (!auth('api')->user()->email_verified_at) {
      return response()->json(['error' => 'Unauthorised'], 401);
    }

    return $this->respondWithToken($token);
  }

  public function verified_auth(Request $request)
  {

    $user = User::where("uniqd", $request->code_user)->first();
    if ($user) {
      $user->update(["email_verified_at" => now()]);
      return response()->json(["message" => 200]);
    }
    return response()->json(["message" => 403]);
  }

  public function me()
    {
        $user = User::find(auth("api")->user()->id);
        return response()->json([
            'name' => $user->name,
            'surname' => $user->surname,
            'phone' => $user->phone,
            'email' => $user->email,
            'bio' => $user->bio,
            'fb' => $user->fb,
            'sexo' => $user->sexo,
            'address_city' => $user->address_city,
            'avatar' => $user->avatar ? env("APP_URL")."storage/".$user->avatar : 'https://cdn-icons-png.flaticon.com/512/1476/1476614.png',
        ]);
    }

  public function logout()
  {
    auth('api')->logout();

    return response()->json(['message' => 'Successfully logged out']);
  }

  public function refresh()
  {
    return $this->respondWithToken(auth('api')->refresh());
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth('api')->factory()->getTTL() * 60,
      'user' => auth('api')->user()
    ]);
  }
}
