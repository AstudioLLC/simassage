<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
//            'type' => 'required|integer',
            'video' => 'required|string',
            'key' => 'required|integer',
            'title' => 'required|array',
            'title.*' => 'nullable|string',
            'name' => 'nullable|max:20480|mimes:flv,mp4,m3u8,ts,3gp,mov,avi,wmv',
            'link' => 'nullable|string',
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
            'mimes' => 'Формат не поддерживается',
            'name.required' => 'Загрузите файл!',
            'name.mimes' => 'Допустимые форматы flv, mp4, m3u8, ts, 3gp, avi, wmv.',
            'name.max' => 'Максимальный размер файла 20мб.',
        ];
    }
}
