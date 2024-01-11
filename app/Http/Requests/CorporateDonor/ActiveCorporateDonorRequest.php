<?php

namespace App\Http\Requests\CorporateDonor;

use Illuminate\Foundation\Http\FormRequest;

class ActiveCorporateDonorRequest extends FormRequest
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
            'itemId' => 'required|integer|exists:corporate_donors,id',
            'value' => 'required|integer',
        ];
    }
}