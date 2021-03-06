<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
        $rules = Group::VALIDATION_RULES;

        if ($this->getMethod() == 'POST') {
            $rules['name'] = ['string', 'min:2', 'max:20', 'unique:groups,name', 'required'];
        }

        return $rules;
    }
}
