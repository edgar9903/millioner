<?php

namespace App\Repositories;


use App\Question;

use App\Repositories\Contracts\QuestionRepositoryInterface;

class QuestionRepository extends Repository implements QuestionRepositoryInterface
{

    /**
     * @var model
     */
    protected $model;

    /**
     *  Construct.
     *
     * @param $question
     * @return void
     */
    public function __construct(Question $question)
    {
        $this->model = $question;
    }

    /**
     *  Get All Question except array $ids.
     *
     * @param array $data
     * @return mixed
     */
    public function whereNotIn(array $data)
    {
        return  $this->model->whereNotIn('id',$data)->get();
    }


}