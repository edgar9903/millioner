<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\QuestionRepository;


use App\Services\AdminService;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests\AdminQuestionRequest;

use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{

    /**
     * @var QuestionRepository
     * @var AdminService
     */
    protected $QuestionRepository;
    protected $AdminService;

    /**
     *  Construct.
     *
     * @param $QuestionRepository
     * @param $AdminService
     * @return void
     */
    public function __construct(QuestionRepository $QuestionRepository,AdminService $AdminService){
        $this->QuestionRepository = $QuestionRepository;
        $this->AdminService = $AdminService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->QuestionRepository->all();
        return view('admin.question.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminQuestionRequest $request)
    {
        $data = [
            'question' => $request->input('question'),
            'point'    => $request->input('point'),

        ];

        $question = $this->AdminService->CreateQuestion($data);

        $answer_data = [
          'right'   => $request->input('right'),
          'answer'  => $request->input('answer')
        ];

        $this->AdminService->CreateAnswer($answer_data,$question->id);

        return Redirect(route('question.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->QuestionRepository->find($id);
        if ($data){
            return view('admin.question.show',compact('data'));
        }
        return Redirect(route('question.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->QuestionRepository->find($id);
        if ($data){
            return view('admin.question.edit',compact('data'));
        }
        return Redirect(route('question.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminQuestionRequest $request, $id)
    {
        $data = [
            'question' => $request->input('question'),
            'point'    => $request->input('point'),

        ];

        $this->AdminService->UpdateQuestion($data,$id);

        $answer_data = [
            'right'   => $request->input('right'),
            'answer'  => $request->input('answer')
        ];
        $this->AdminService->UpdateAnswer($answer_data,$id);

        return Redirect(route('question.show',['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->QuestionRepository->delete($id);
        return Redirect(route('question.index'));
    }
}
