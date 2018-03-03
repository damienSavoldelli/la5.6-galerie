<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
// use App\Http\Resources\ImageByCategoryResource;
use App\Repositories\ImageRepository;

use App\Models\ { Category, Image, User };

class imageController extends Controller
{

    protected $repository;

    /**
     * Create a new ImageController instance.
     *
     * @param  \App\Repositories\ImageRepository $repository
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $images = Image::latestWithUser()->paginate(config('app.pagination'));
      return ImageResource::collection($images);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing by catgory slug
     *
     * @param  [type] $slug
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {

        $category = Category::whereSlug($slug)->firstorFail();
        $images = $this->repository->getImagesForCategory($slug);
        return ImageResource::collection($images);

        // use App\Http\Resources\ImageResource to serialize
        // return new ImageByCategoryResource(compact('category', 'images'));
    }

    /**
     *  Display a listing by user
     * @param  User   $user
     * @return \Illuminate\Http\Response
     */
    public function user(User $user)
    {
        $images = $this->repository->getImagesForUser($user->id);
        return ImageResource::collection($images);
    }
}
