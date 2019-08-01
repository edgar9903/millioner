<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'rate',
        'finish',
    ];

    /**
     * get question from question_id.
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    /**
     * get game question from game_id.
     *
     * @return mixed
     */
    public function getGameQuestion()
    {
        return $this->hasMany(GamesQuestion::class,'game_id');
    }
}
