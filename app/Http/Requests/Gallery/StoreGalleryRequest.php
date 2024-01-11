<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
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
            'gallery'=>'required|string',
            'key'=>'required|integer',
            'images'=>'required|array',
            'images.*'=>'image|mimes:png,jpeg,webp'
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
            'images.required'=>'Выберите изоброжение',
            'array'=>'Выберите изоброжение',
            'image'=>'Формат не поддерживается',
            'mimes'=>'Формат не поддерживается',
        ];
    }
}
