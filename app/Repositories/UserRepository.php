<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;

use App\User;

class UserRepository extends Repository implements UserRepositoryInterface
{

    /**
     * @var model
     */
    protected $model;

    /**
     *  Construct.
     *
     * @param $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }


}