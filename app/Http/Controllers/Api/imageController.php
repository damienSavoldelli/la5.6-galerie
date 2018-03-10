<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
// use App\Http\Resources\ImageByCategoryResource;
use App\Repositories\ImageRepository;

use App\Models\ { Category, Image, User };

/**
 * @resource Picture
 *
 */
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
     * Picture GET
     * Display a listing of the resource in Picture.
     * Authorization: Bearer authentify
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $images = Image::latestWithUser()->paginate(config('app.pagination'));
      return ImageResource::collection($images);
    }

    /**
     * Picture POST
     * Store a newly created resource in Picture.
     * Authorization: Bearer acces_token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
          'image' => 'required|image|max:2000',
          'category_id' => 'required|exists:categories,id',
          'description' => 'nullable|string|max:255',
      ]);
      $this->repository->store($request);

      return response()->json(array(
          'message'   =>   __("L'image a bien été enregistrée")
      ), 200);
    }

    /**
     * Picture PUT
     * Update the specified resource in storage.
     * Authorization: Bearer acces_token
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Image   $image
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Image $image)
     {
        $this->authorize('manage', $image);
        $image->category_id = $request->category_id;
        $image->save();
        return response()->json(array(
            'message'   =>   __("L'image a bien été mise à jour")
        ), 200);
     }

    /**
     * Picture DELETE
     * Remove the specified resource from storage.
     * Authorization: Bearer acces_token
     *
     * @param  Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $this->authorize('manage', $image);
        $image->delete();
        return response()->json(array(
            'message'   =>   __("L'image a bien été supprimé")
        ), 200);
    }

    /**
     * Picture Category GET
     * Display a listing of pictures by catgory slug
     *
     * @response {
     *  data: ['test' => ''],
     * }
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
     * Picture User GET
     * Display a listing of pictures by user
     *
     * @param  User   $user
     * @return \Illuminate\Http\Response
     */
    public function user(User $user)
    {
        $images = $this->repository->getImagesForUser($user->id);
        return ImageResource::collection($images);
    }
}
