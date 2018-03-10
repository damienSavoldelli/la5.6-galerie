<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

/**
 * @resource Category
 *
 * Categories of pictures
 */
class CategoryController extends Controller
{
    /**
     * Category GET
     * Display a listing of the Category resource.
     * Authorization: Bearer acces_token
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    /**
     * Category POST
     * Store a newly created resource in Category.
     * Authorization: Bearer acces_token
     *
     * @param  CategoryRequest  $request
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
     * Category PUT
     * Update the specified resource in Category.
     * Authorization: Bearer acces_token
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
     * Category DELETE
     * Remove the specified resource from Category.
     * Authorization: Bearer acces_token
     *
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
