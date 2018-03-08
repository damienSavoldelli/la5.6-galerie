<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
      Category::create($request->all());
      return response()->json(array(
          'message'   =>   __('La catégorie a bien été enregistrée')
      ), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest $request
     * @param  Category        $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
      $category->update($request->all());

      return response()->json(array(
          'message'   =>   __('La catégorie a bien été modifiée')
      ), 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Category $category
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
      $category->delete();
      return response()->json(array(
          'message'   =>   __('La catégorie a bien été supprimé')
      ), 200);
    }
}
