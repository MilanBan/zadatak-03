<?php

namespace App\Http\Requests;

use App\Models\Mentor;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Http\FormRequest;

class MentorRequest extends FormRequest
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
        $rulesU = new UserRequest;
        $rulesU = $rulesU->rules(); 
        
        $rulesM = Mentor::VALIDATION_RULES;
        
        
        if ($this->getMethod() == 'POST') {
            array_push($rulesU['city'], 'required');
            array_push($rulesM['skype'], 'required');
        }

        $rules = array_merge($rulesU,$rulesM);

        return $rules;
    }
}
