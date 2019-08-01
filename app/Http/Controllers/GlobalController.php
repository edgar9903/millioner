<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GlobalController extends Controller
{
    /**
     * @var UserService
     */
    protected $UserService;

    /**
     *  Construct.
     *
     * @param $UserService
     * @return void
     */
    public function __construct(UserService $UserService){

        $this->UserService        = $UserService;
    }

    /**
     * Check user type after login.
     *
     * @return mixed
     */
    public function CheckType()
    {
        if (Auth::user()->type() == User::User){
            return redirect(route('user.home'));
        }
        return redirect(route('question.index'));
    }

    /**
     * Top user.
     *
     * @return void
     */
    public function top()
    {
        $users = $this->UserService->top();
        return view('user.top',compact('users'));
    }


}
