<?php

namespace App\Http\Requests\Administrators;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateAdministratorRequest extends FormRequest
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
            'role' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->id,
        ];
    }
}
