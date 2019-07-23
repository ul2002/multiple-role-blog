<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Traits\BaseRepository;

class UserRepository
{
    use BaseRepository;

    /**
     * @var user
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user; 
    }

    /**
     * @param $input
     * @return Model
     */
    public function store($input)
    {
        $input['password'] = bcrypt($input['password']);
        return $this->save($this->model, $input);
    }
}