<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreLanguageRequest extends FormRequest
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
        $request['default'] = (int)!empty($request['default']);
        $request['admin'] = (int)!empty($request['admin']);
        $request['url'] = (int)!empty($request['url']);
        $request['active'] = (int)!empty($request['active']);

        $this->merge([
            'default' => $request['default'],
            'admin' => $request['admin'],
            'url' => $request['url'],
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
            'iso' => 'required|string|max:2|unique:languages,iso',
            'title' => 'required|string',
        ];
    }
}
