<?php

namespace App\Http\Requests;

use App\Rules\ProductCodeRule;
use App\Rules\ProductNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    const ACTIVE = 1;
    const IN_ACTIVE = 0;

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
        $items = Input::get();
        $rules = [
            'status' => ['required', Rule::in([0, 1])],
            'product_name_txt' => ['required', 'string', 'max:255']
        ];
        if (strpos(url()->previous(), 'confirm') && !empty($items['redirect'])) {
            $this->redirect = $items['redirect'];
        }
        return $rules;
    }

    /**
     * Custom message.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'product_name_txt.required' => 'Required',
            'product_name_txt.string' => 'Must String',
            'product_name_txt.max' => 'Max 255',
            'status.required' => 'Please select',
            'status.in' => 'Status not in',
        ];
    }
}
