<?php

namespace App\Http\Requests\NotificationText;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationTextRequest extends FormRequest
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
            'contact_message' => 'nullable|array',
            'thanks_message' => 'nullable|array',
            'adult_message' => 'nullable|array',
        ];
    }
}
