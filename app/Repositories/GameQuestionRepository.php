<?php

namespace App\Repositories;


use App\Answer;

use App\GamesQuestion;
use App\Repositories\Contracts\AnswerRepositoryInterface;

class GameQuestionRepository extends Repository implements AnswerRepositoryInterface
{

    /**
     * @var model
     */
    protected $model;

    /**
     *  Construct.
     *
     * @param $GamesQuestion
     * @return void
     */
    public function __construct(GamesQuestion $GamesQuestion)
    {
        $this->model = $GamesQuestion;
    }


    /**
     * Remove answer record from the database from question_id
     *
     * @param int $question_id
     */
    public function DeleteAnswerFromQuestionID(int $question_id)
    {
        $this->model->where('question_id',$question_id)->delete();
    }

}