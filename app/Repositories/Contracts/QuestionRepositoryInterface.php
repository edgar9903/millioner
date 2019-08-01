<?php

namespace App\Repositories\Contracts;

interface QuestionRepositoryInterface
{

    /**
     *  Get All Question except array $ids.
     *
     * @param array $data
     * @return mixed
     */
    public function whereNotIn(array $data);
}