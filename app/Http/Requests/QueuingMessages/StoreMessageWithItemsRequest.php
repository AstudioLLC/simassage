<?php

namespace App\Http\Requests\QueuingMessages;
use Illuminate\Foundation\Http\FormRequest;

class StoreMessageWithItemsRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required|integer',
            'date' => 'required',
            'service' => 'string|max:255',
            'message' => 'nullable|string',
            'items' => 'nullable',
            'g-recaptcha-response' => 'required',
        ];
    }
}
