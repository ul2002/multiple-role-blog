<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Traits\BaseRepository;

class PostRepository
{
    use BaseRepository;

    const MEMBER = 'MEMBER';


    /**
     * @var Post
     */
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    /**
     * Get all the records
     *
     * @return array Model
     */
    public function all($user = null)
    {
        if ($user) {
            if ($user->role == self::MEMBER) {
                return $this->model->where('user_id', $user->id)->get();
            }
        }
        
        return $this->model->get();
    }
}