<?php

namespace App\Http\Requests\Frontend\Chat;

use Illuminate\Foundation\Http\FormRequest;

class StoreChatRequest extends FormRequest
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
            'message' => 'nullable',
            'file' => 'nullable',
            'message_from' => 'required|integer',
            'is_read' => 'required|integer',
            'sponsor_id' => 'required|integer|exists:users,id',
            'children_id' => 'required|integer|exists:childrens,id',
        ];
    }
}
