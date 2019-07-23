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
     * @var user
     */
    protected $user;

    /**
     * @var postRepository
     */
    protected $postRepository;


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
        $this->authorize('view', Post::class);
        $posts = $this->postRepository->all($this->user);

        return new PostCollectiionResource($posts);
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);
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
        $this->authorize('viewSingle', new Post(['user_id' => isset($post) ? $post->user_id : null]));

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
        $post = $this->postRepository->getById($id);
        $this->authorize('update', new Post(['user_id' => isset($post) ? $post->user_id : null]));
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
        $post = $this->postRepository->getById($id);
        $this->authorize('delete', new Post(['user_id' => isset($post) ? $post->user_id : null]));
        $post = $this->postRepository->delete($id);

        if( is_null($post) ) {
            return response()->json('Invalid object id',self::HTTP_NOTFOUND);
        }

        return response()->json('the Post has been deleted',self::HTTP_SUCCESS);
    }
}