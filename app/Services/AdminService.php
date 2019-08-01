<?php

namespace App\Services;

use App\Repositories\AnswerRepository;

use App\Repositories\QuestionRepository;

class AdminService
{

    /**
     * @var QuestionRepository
     * @var AnswerRepository
     */
    protected $QuestionRepository;
    protected $AnswerRepository;

    /**
     *  Construct.
     *
     * @param $QuestionRepository
     * @param $AnswerRepository
     * @return void
     */
    public function __construct(QuestionRepository $QuestionRepository,AnswerRepository $AnswerRepository){
        $this->QuestionRepository = $QuestionRepository;
        $this->AnswerRepository = $AnswerRepository;
    }

    /**
     * Set question.
     *
     * @param array $data
     * @return mixed
     */
    public function CreateQuestion(array $data){
       return $this->QuestionRepository->create($data);
    }


    /**
     * update question.
     *
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function UpdateQuestion(array $data,int $id){
        return $this->QuestionRepository->update($data,$id);
    }

    /**
     * Set answer.
     *
     * @param array $data
     * @param int $question_id
     */
    public function CreateAnswer(array $data,int  $question_id){


        foreach ($data['answer'] as $key => $answer){

            $right = 0;

            if ($key == $data['right']){
                $right = 1;
            }

            $new_data = [
                'answer'      => $answer,
                'right'       => $right,
                'question_id' => $question_id,
            ];

            $this->AnswerRepository->create($new_data);
        }
    }


    /**
     * update answer.
     *
     * @param array $data
     * @param int $question_id
     * @return mixed
     */
    public function UpdateAnswer(array $data,int $question_id){

        $this->AnswerRepository->DeleteAnswerFromQuestionID($question_id);

        foreach ($data['answer'] as $key => $answer){
            $right = 0;

            if ($key == $data['right']){
                $right = 1;
            }

            $new_data = [
                'answer'      => $answer,
                'right'       => $right,
                'question_id' => $question_id,
            ];

            $this->AnswerRepository->create($new_data);
        }
    }
}