<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollectiion as UserCollectiionResource;

class UserController extends Controller
{
    /**
     * @var userRepository
     */
    protected $userRepository;


    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $this->authorize('view', User::class);
     $users = $this->userRepository->all();

     return   new UserCollectiionResource($users);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);
        $input = $request->all();
        $user = $this->userRepository->store($input);

        return response()->json(['id'=>$user->id],self::HTTP_SUCCESS);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $int
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        $this->authorize('viewSingle', new User(['id' => isset($user) ? $user->id : null]));

        if(is_null($user)) {
           return response()->json('Invalid object id',self::HTTP_NOTFOUND);
        }

        return  new UserResource($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input = $request->all('firstname','lastname','phone','role','gender');
        $user = $this->userRepository->getById($id);
        $this->authorize('update', new User(['id' => isset($user) ? $user->id : null]));
        $user = $this->userRepository->update($id,$input);

         if( is_null($user) ) {
            return response()->json('Invalid object id',self::HTTP_NOTFOUND);
        }

        return response()->json(['id'=>$user->id],self::HTTP_SUCCESS);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->getById($id);
        $this->authorize('delete', new User(['id' => isset($user) ? $user->id : null]));
        $user = $this->userRepository->delete($id);

        if( is_null($user) ) {
            return response()->json('Invalid object id',self::HTTP_NOTFOUND);
        }

        return response()->json('the User has been deleted',self::HTTP_SUCCESS);
    }
}