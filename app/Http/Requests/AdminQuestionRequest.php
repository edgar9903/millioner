<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required',
            'point'    => 'required|numeric|min:5|max:20',
            'answer.*' => 'required',
            'right'    => 'required',
        ];
    }


    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator){

            foreach($this->answer as $answer)
            {
                if(empty($answer)){
                    $validator->errors()->add('answers', 'The answer field is required.');
                    return;
                }
            }
        });
    }
}
