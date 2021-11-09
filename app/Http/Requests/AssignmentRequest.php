<?php

namespace App\Http\Requests;

use App\Models\Assignment;
use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Assignment::VALIDATION_RULES;

        if ($this->getMethod() == 'POST') {
            array_push($rules['name'], 'required');
            array_push($rules['description'], 'required');
        }

        return $rules;
    }
}
