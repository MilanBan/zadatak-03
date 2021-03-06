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

        if ($this->getMethod() == 'POST') {
            $rules['firstName'] = ['string', 'min:2', 'max:20', 'required'];
            $rules['lastName'] = ['string', 'min:2', 'max:20', 'required'];
            $rules['email'] = ['string', 'email', 'max:255', 'required', 'unique:users,email'];
            $rules['password'] = ['required', 'string', 'confirmed', 'min:8'];
        }

        return $rules;
    }
}
