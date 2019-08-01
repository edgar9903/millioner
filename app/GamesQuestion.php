<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamesQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id',
        'answer_id',
        'question_id',
        'right',
    ];

    /**
     * get game from game_id.
     *
     * @return mixed
     */
    public function getGame()
    {
        return $this->belongsTo(Game::class,'game_id');
    }

    /**
     * get question from question_id.
     *
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->belongsTo(Question::class,'question_id');
    }

    /**
     * get answer from answer_id.
     *
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->belongsTo(Answer::class,'answer_id');
    }
}
