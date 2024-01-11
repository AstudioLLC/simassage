<?php

namespace App\Http\Requests\Subscriber;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreSubscriberRequest extends FormRequest
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->request = $request;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $request = $this->request->all();
        $request['active'] = (int)!empty($request['active']);

        $this->merge([
            'active' => $request['active'],
        ]);
    }

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
            'email' => 'required|string|email|max:255|unique:subscribers,email',
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
            'email' => 'unique',
        ];
    }
}
