<?php

namespace App\Repositories;


use App\Answer;

use App\Repositories\Contracts\AnswerRepositoryInterface;

class AnswerRepository extends Repository implements AnswerRepositoryInterface
{

    /**
     * @var model
     */
    protected $model;

    /**
     *  Construct.
     *
     * @param $answer
     * @return void
     */
    public function __construct(Answer $answer)
    {
        $this->model = $answer;
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