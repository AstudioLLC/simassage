<?php

namespace App\Http\Requests\Frontend\Fundraisers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostCreateStep2Request extends FormRequest
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
        $session = Session::get('fundraiser');
        $request['checkbox'] = (int)!empty($request['checkbox']);
        $this->merge([
            'id' => $session['id'],
            'anonymous' => $session['anonymous'],
            'amount' => $session['amount'],
            'message' => $session['message'],
            'checkbox' => $request['checkbox'],
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
            'id' => 'required|integer|exists:fundraisers,id',
            'anonymous' => 'required|integer',
            'amount' => 'required|integer',
            'message' => 'nullable|string',
            'checkbox' => 'required',
        ];
    }
}
