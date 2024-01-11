<?php

namespace App\Http\Requests\Directorate2;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDirectoratesRequest extends FormRequest
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
            'itemId' => 'required|integer|exists:administrators,id',
        ];
    }
}
