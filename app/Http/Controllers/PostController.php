<?php

namespace App\Http\Controllers;

use JWTAuth;
use Validator;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollectiion as PostCollectiionResource;


class PostController extends Controller
{
    /**
     * @var postRepository
     */
    protected $postRepository;

    /**
     * @var User
     */
    protected $user;


    /**
     * PostController constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     $posts = $this->postRepository->all();
     //var_dump($Posts); die();
     return   new PostCollectiionResource($posts);

    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
 
        $input = $request->all();
        $input['user_id']=  $this->user->id;
        $post = $this->postRepository->store($input);
        return response()->json(['id'=>$post->id],self::HTTP_SUCCESS);

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $int
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postRepository->getById($id);

        if(is_null($post)) {
           return response()->json('Invalid object id',self::HTTP_NOTFOUND);
        }


        return  new PostResource($post);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $input = $request->all();
        $post = $this->postRepository->update($id,$input);
         if( is_null($post) ) {
            return response()->json('Invalid object id',self::HTTP_NOTFOUND);
        }

        return response()->json(['id'=>$post->id],self::HTTP_SUCCESS);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= $this->postRepository->delete($id);
        if( is_null($post) ) {
            return response()->json('Invalid object id',self::HTTP_NOTFOUND);
        }
        return response()->json('the Post has been deleted',self::HTTP_SUCCESS);
    }
}