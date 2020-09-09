<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Support\Facades\Auth;
use Session;
class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Session::check();
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
            // 'current_password' =>['required','string',new CurrentPassword()],
            'password' => ['required','string','min:8','confirmed'],
        ];
    }
}
