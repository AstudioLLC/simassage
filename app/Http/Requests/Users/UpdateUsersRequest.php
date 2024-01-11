<?php
namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateUsersRequest extends FormRequest
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

        // Use the 'sometimes' validation rule to make a field required only if it's provided.
        return [
            'name' => 'sometimes|string|min:3|max:255',
            'email' => 'sometimes|email:dns|unique:users,email,' . $this->id,
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.*.required' => 'Name is required.',
            'email.*.required' => 'Email is required.',
            'password' => 'Password is required.',
            'password_confirmation' => 'Password Confirmation is required.',
        ];
    }
}

