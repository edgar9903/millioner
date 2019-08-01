<?php

namespace App\Repositories;


use App\Game;

use App\Repositories\Contracts\GameRepositoryInterface;

class GameRepository extends Repository implements GameRepositoryInterface
{

    /**
     * @var model
     */
    protected $model;

    /**
     *  Construct.
     *
     * @param $game
     * @return void
     */
    public function __construct(Game $game)
    {
        $this->model = $game;
    }


}