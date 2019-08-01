<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer',
        'right',
        'question_id',
    ];

    /**
     * get question from question_id.
     *
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->belongsTo(Question::class,'question_id');
    }
}
