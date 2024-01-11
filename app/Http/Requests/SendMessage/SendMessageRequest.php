<?php

namespace App\Http\Requests\SendMessage;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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
            'name' => 'required|string|max:200',
            'email' => 'required|string|email|max:200',
            'phone' => 'required|string|phone|max:200',
            'message' => 'required|string|max:1000',
            'doctor_name' => 'string',
//            'g-recaptcha-response' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Լրացրեք դաշտը.',
            'string' => 'Լրացրեք դաշտը.',
            'email' => 'Էլփոստի հասցեն անվավեր է',
            'phone' => 'Հեռախոսահամարն անվավեր է',
            'max' => 'Նիշերի թիվը չի կարող գերազանցել :max.',
        ];
    }

}
