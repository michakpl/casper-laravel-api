<?php namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
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
            'username'  => 'unique:users|required|string',
            'email'     => 'unique:users|required|email',
            'password'  => 'required|confirmed',
            'gender'    => 'required|in:other,male,female',
            'birthdate' => 'required|date'
        ];
    }
}
