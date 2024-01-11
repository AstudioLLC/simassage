<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateUserInfoRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'country_id' => 'nullable|integer|exists:countries,id',
        ];
    }
}
