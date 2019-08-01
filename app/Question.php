<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'point'
    ];

    /**
     * get answers from question_id.
     *
     * @return mixed
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::class,'question_id');
    }
}
