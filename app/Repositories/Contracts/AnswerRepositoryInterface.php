<?php

namespace App\Repositories\Contracts;

interface AnswerRepositoryInterface
{

    /**
     * Remove answer record from the database from question_id
     *
     * @param int $question_id
     */
    public function DeleteAnswerFromQuestionID(int $question_id);
}