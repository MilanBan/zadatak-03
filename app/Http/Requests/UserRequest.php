<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = User::VALIDATION_RULES;

        if($this->getMethod() == 'POST') {
            $rules['firstName'] = 'required'; 
            $rules['lastName'] = 'required'; 
            array_push($rules['email'],'required','unique:users,email'); 
            $rules['password'] = 'required';
        }

        return $rules;
    }
}
