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
            array_push($rules['city'], 'required');
            array_push($rules['telephone'], 'required');
            array_push($rules['firstName'], 'required');
            array_push($rules['lastName'], 'required');
            array_push($rules['email'],'required','unique:interns,email');            $rules['address'] = 'required';
            array_push($rules['cv'], 'required');
            array_push($rules['github'], 'required');
        }

        return $rules;
    }
}
