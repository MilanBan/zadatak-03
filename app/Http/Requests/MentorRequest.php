<?php

namespace App\Http\Requests;

use App\Http\Requests\UserRequest;
use App\Models\Mentor;
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
            $rulesM['city'] = ['string', 'min:2', 'max:20', 'required'];
            $rulesM['skype'] = ['string', 'min:2', 'max:20', 'required'];
        }

        $rules = array_merge($rulesU, $rulesM);

        return $rules;
    }
}
