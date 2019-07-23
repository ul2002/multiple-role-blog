<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Traits\BaseRepository;

class PostRepository
{
    use BaseRepository;

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
}