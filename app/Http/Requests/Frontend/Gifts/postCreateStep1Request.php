<?php

namespace App\Http\Requests\Frontend\Gifts;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class postCreateStep1Request extends FormRequest
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
            'id' => 'required|integer|exists:gifts,id',
            'cost' => 'required|integer',
            'count' => 'required|integer',
        ];
    }

    /**
     * Get the validation fail meessages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
