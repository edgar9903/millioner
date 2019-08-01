<?php

namespace App\Services;

use App\Repositories\AnswerRepository;

use App\Repositories\GameQuestionRepository;

use App\Repositories\GameRepository;

use App\Repositories\QuestionRepository;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class UserService
{

    /**
     * @var QuestionRepository
     * @var AnswerRepository
     * @var GameRepository
     * @var GameQuestionRepository
     * @var UserRepository
     */
    protected $QuestionRepository;
    protected $AnswerRepository;
    protected $GameRepository;
    protected $GameQuestionRepository;
    protected $UserRepository;



    /**
     *  Construct.
     *
     * @param $QuestionRepository
     * @param $AnswerRepository
     * @param $GameRepository
     * @param $GameQuestionRepository
     * @return void
     */
    public function __construct(
        QuestionRepository $QuestionRepository,
        AnswerRepository $AnswerRepository,
        GameRepository $GameRepository,
        GameQuestionRepository $GameQuestionRepository,
        UserRepository  $UserRepository
    ){
        $this->QuestionRepository     = $QuestionRepository;
        $this->AnswerRepository       = $AnswerRepository;
        $this->GameRepository         = $GameRepository;
        $this->GameQuestionRepository = $GameQuestionRepository;
        $this->UserRepository         = $UserRepository;
    }

    /**
     *  Check game finish.
     *
     * @return void
     */
    public function checkGameFinish(){

        $param = [
            'user_id' => Auth::user()->id,
            'finish' => 0,
            ];
        $data = $this->GameRepository->where($param);


        $rate = Auth::user()->rate;
        foreach ($data as $game){

            if($game->rate > $rate){
                $rate = $game->rate;
                $this->UserRepository->update(['rate' => $game->rate],Auth::user()->id);
            }

            if ($game->finish == 0){
                if (count($game->getGameQuestion) == 1){
                    if (is_null($game->getGameQuestion->first()->answer_id)){
                        $this->GameRepository->delete($game->id);
                        return;
                    }
                }
                $this->GameRepository->update(['finish' => 1],$game->id);
            }
        }
    }

    /**
     *  Start game.
     *
     * @return mixes
     */
    public function startGame(){

        $this->checkGameFinish();

        $param = [
            'user_id' => Auth::user()->id
        ];

        $game = $this->GameRepository->create($param);
        $question = $this->QuestionRepository->all();

        $rand_question = $question->random(1)->first();

        $question_param = [
            'question_id' => $rand_question->id,
            'game_id'     => $game->id,
        ];

        $this->GameQuestionRepository->create($question_param);

        return $rand_question;

    }

    /**
     *  Confirm game answer.
     *
     * @param int $id
     * @return mixed
     */
    public function ConfirmAnswer(int $id){
        $param = [
            'user_id' => Auth::user()->id,
            'finish'  => 0,
        ];

        if($answer = $this->AnswerRepository->find($id)){

            $game = $this->GameRepository->where($param);


            $gameQuestion = $game
                ->last()
                ->getGameQuestion;

            if($answer->right == 1){
                $rate = $answer->getQuestion->point;
                $rate = $game->last()->rate+$rate;

                $this->GameRepository->update(['rate' => $rate],$game->last()->id);
            }

            $answer_param = [
                'right'     => $answer->right,
                'answer_id' => $answer->id
            ];

            $this->GameQuestionRepository->update($answer_param,$gameQuestion->last()->id);

            if (count($gameQuestion) == 5){
                return false;
            }

            $question_ids = $gameQuestion->pluck('question_id')->toArray();
            return $this->newQuestion($question_ids,$game->last()->id);
        }

        return false;

    }

    /**
     *  Start  new question.
     *
     * @param array $data
     * @param int $game_id
     * @return mixed
     */
    public function newQuestion(array $data,int $game_id){
        $questions = $this->QuestionRepository->whereNotIn($data);

        if($questions->first()){
            $rand_question = $questions->random(1)->first();

            $question_param = [
                'question_id' => $rand_question->id,
                'game_id'     => $game_id,
            ];

            $this->GameQuestionRepository->create($question_param);

            return $rand_question;
        }

        return false;
    }

    /**
     *  Get top 10 user.
     *
     * @return mixed
     */
    public function top(){

        $users = $this->UserRepository->where(['type' => User::User],10,'rate');
        return $users;
    }


}