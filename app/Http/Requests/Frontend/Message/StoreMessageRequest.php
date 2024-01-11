<?php

namespace App\Http\Requests\Frontend\Message;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreMessageRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|max:255',
            'email' => 'email:rfc,dns',
            'date' => 'required',
            'time' => 'required|string',
            'message' => 'nullable|string',
//            'g-recaptcha-response' => 'required',
        ];
    }
}
