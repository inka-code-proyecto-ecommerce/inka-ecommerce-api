<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\CategorieCollection;
use App\Http\Resources\Product\CategorieResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Product\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $categories = Categorie::where("name", "like", "%" . $search . "%")->orderBy("id", "desc")->paginate(25);
        return response()->json([
            "total" => $categories->total(),
            "categories" => CategorieCollection::make($categories)
        ]);
    }

    public function config()
    {
        $categories_first = Categorie::where("second_id", null)->where("third_id", null)->get();
        $categories_second = Categorie::where("second_id", "<>", null)->where("third_id", null)->get();
        return response()->json(["categories_first" => $categories_first, "categories_second" => $categories_second]);
    }

    public function store(Request $request)
    {
        $is_exists = Categorie::where("name", $request->name)->first();
        if ($is_exists) {
            return response()->json(["message" => 403]);
        }
        if ($request->hasFile("image")) {
            $path = Storage::putFile("categories", $request->file("image"));
            $request->request->add(["imagen" => $path]);
        }
        $categorie = Categorie::create($request->all());
        return response()->json(["message" => 201]);
    }

    public function show(string $id)
    {
        $category = Categorie::findOrFail($id);
        return response()->json(["category" => CategorieResource::make($category)]);
    }

    public function update(Request $request, string $id)
    {
        $is_exists = Categorie::where("id", "<>", $id)->where("name", $request->name)->first();
        if ($is_exists) {
            return response()->json(["message" => 403]);
        }
        $category = Categorie::findOrFail($id);
        if ($request->hasFile("image")) {
            if ($category->imagen) {
                Storage::delete($category->imagen);
            }
            $path = Storage::putFile("categories", $request->file("image"));
            $request->request->add(["imagen" => $path]);
        }
        $category->update($request->all());
        return response()->json(["message" => 201]);
    }

    public function destroy(string $id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();
        // Validar la categoria que no este en ningun producto
        return response()->json(["category" => $category]);
    }
}
