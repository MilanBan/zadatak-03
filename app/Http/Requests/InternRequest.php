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

        
            $rules['city'] = ['string', 'min:2', 'max:20', 'required'];
            $rules['telephone'] = ['string', 'min:2', 'max:20', 'required'];
            $rules['firstName'] = ['string', 'min:2', 'max:20', 'required'];
            $rules['lastName'] = ['string', 'min:2', 'max:20', 'required'];
            $rules['email'] = ['string', 'email', 'max:255', 'required', 'unique:interns,email'];
            $rules['address'] = ['string', 'min:2', 'required'];
            $rules['cv'] = ['mimes:,doc,docx,pdf', 'max:10000', 'required'];
            $rules['github'] = ['string', 'url', 'required'];
            $rules['group_id'] = ['exists:groups,id', 'required'];
        

        return $rules;
    }
}
