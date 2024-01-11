<?php

namespace App\Http\Requests\DepartmentsInformation;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDepartmentsInformationRequest extends FormRequest
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
            'itemId' => 'required|integer|exists:departments_information,id',
        ];
    }
}
