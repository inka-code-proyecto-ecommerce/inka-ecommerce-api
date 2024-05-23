<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\CategoryCollection;
use App\Http\Resources\Product\CategoryResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Product\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $categories = Category::where("name", "like", "%" . $search . "%")->orderBy("id", "desc")->paginate(25);
        return response()->json([
            "total" => $categories->total(),
            "categories" => CategoryCollection::make($categories)
        ]);
    }

    public function config()
    {
        $categories_first = Category::where("second_id", NULL)->where("third_id", NULL)->get();
        $categories_second = Category::where("second_id", "<>", NULL)->where("third_id", NULL)->get();
        return response()->json(["categories_first" => $categories_first, "categories_second" => $categories_second]);
    }

    public function store(Request $request)
    {
        $is_exists = Category::where("name", $request->name)->first();
        if ($is_exists) {
            return response()->json(["message" => 403]);
        }
        if ($request->hasFile("image")) {
            $path = Storage::putFile("categories", $request->file("image"));
            $request->request->add(["imagen" => $path]);
        }
        $category= Category::create($request->all());
        return response()->json(["message" => 201]);
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json(["category" => CategoryResource::make($category)]);
    }

    public function update(Request $request, string $id)
    {
        $is_exists = Category::where("id", "<>", $id)->where("name", $request->name)->first();
        if ($is_exists) {
            return response()->json(["message" => 403]);
        }
        $category = Category::findOrFail($id);
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
        $category = Category::findOrFail($id);
        $category->delete();
        // Validar la categoria que no este en ningun producto
        return response()->json(["category" => $category]);
    }
}
