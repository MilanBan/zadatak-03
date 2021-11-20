<?php

namespace App\Http\Requests;

use App\Models\Review;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
        $rules = Review::VALIDATION_RULES;

        if ($this->getMethod() == 'POST') {
            $rules['mark'] = ['integer', 'between:1,10', 'required'];
            $rules['pros'] = ['string', 'min:1', 'max:1000', 'required'];
            $rules['cons'] = ['string', 'min:1', 'max:1000', 'required'];
        }

        return $rules;
    }
}
