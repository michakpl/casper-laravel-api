<?php namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class EventStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'                => 'required|string',
            'location'             => 'required|string',
            'description'          => 'required|string',
            'starts_at'            => 'required|date',
            'duration'             => 'required|numeric|min:0',
            'registration_ends_at' => 'required|date',
            'is_private'           => 'boolean'
        ];
    }
}
