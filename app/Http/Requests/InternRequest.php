<?php

namespace App\Http\Requests;

use App\Models\Intern;
use Illuminate\Foundation\Http\FormRequest;

class InternRequest extends FormRequest
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
        $rules = Intern::VALIDATION_RULES;
        
        if ($this->getMethod() == 'POST') {
            $rules['city'] = 'required';
            $rules['telephone'] = 'required';
            $rules['firstName'] = 'required';
            $rules['lastName'] = 'required';
            $rules['email'] = 'required';
            $rules['address'] = 'required';
            $rules['cv'] = 'required';
            $rules['git'] = 'required';
        }

        return $rules;
    }
}
