<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tweet' => 'required',
            'counter' => 'integer|between:1,10',
            function ($attribute, $value, $fail)
            {
                $user = auth()->user();
                $date = \Carbon\Carbon::createFromDate($user->last_tweet);
                    if($user->post_counter >= 10 || $date->isToday()) {
                        $fail('You Cant Post Today');
                    }
            }
            
        ];
    }
}
