<?php

namespace App\Http\Controllers\User;

use App\Repositories\GameRepository;

use App\Repositories\QuestionRepository;

use App\Services\UserService;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Crypt;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    /**
     * @var QuestionRepository
     * @var GameRepository
     * @var UserService
     */
    protected $QuestionRepository;
    protected $GameRepository;
    protected $UserService;

    /**
     *  Construct.
     *
     * @param $QuestionRepository
     * @param $GameRepository
     * @param $UserService
     * @return void
     */
    public function __construct(QuestionRepository $QuestionRepository,GameRepository $GameRepository,UserService $UserService){

        $this->QuestionRepository   = $QuestionRepository;
        $this->GameRepository       = $GameRepository;
        $this->UserService          = $UserService;
    }

    /**
     * User Dashboard.
     *
     * @return void
     */
    public function index(){

        $this->UserService->checkGameFinish();

        $games = $this->GameRepository->where(['user_id' => Auth::user()->id],null,'id');

        return view('user.index',compact('games'));
    }

    /**
     * Start Game.
     *
     * @return void
     */
    public function start(){

        $question = $this->UserService->startGame();

        return view('user.start',compact('question'));
    }

    /**
     * Confirm Game.
     *
     * @return void
     */
    public function confirm(Request $request){
       if ($id = Crypt::decrypt($request->input('answer'))){
           if($question = $this->UserService->ConfirmAnswer($id)){
               return view('user.start',compact('question'));
           }
       }

       return Redirect(route('user.home'));
    }

    /**
     * Game Info.
     *
     * @return void
     */
    public function gameInfo($id){

        $games = $this->GameRepository->where(['user_id' => Auth::user()->id]);
        $game_ids = $games->pluck('id')->toArray();
        if (in_array($id,$game_ids)){
            $game = $this->GameRepository->find($id);
            return view('user.info',compact('game'));
        }
        return Redirect(route('user.home'));
    }
}
