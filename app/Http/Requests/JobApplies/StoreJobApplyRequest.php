<?php

namespace App\Http\Requests\JobApplies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreJobApplyRequest extends FormRequest
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
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:200',
            'email' => 'string|email|max:200',
            'phone' => 'required|integer',
            'message' => 'nullable|string|max:1000',
            'job_position' => 'string|max:1000',
//            'file' => 'mimes:doc,docx,pdf|max:2048', // 2 MB limit (2048 KB)
//            'g-recaptcha-response' => 'required',
        ];
    }

//    public function messages()
//    {
//        return [
//            'file.max' => 'The file may not be greater than 2 megabytes.', // Custom error message for file size limit
//        ];
//    }

}
