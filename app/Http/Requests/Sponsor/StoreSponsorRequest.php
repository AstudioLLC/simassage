<?php

namespace App\Http\Requests\Sponsor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreSponsorRequest extends FormRequest
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
        //dd($request);
        $request['active'] = (int)!empty($request['active']);
        $request['recurring_payment'] = (int)!empty($request['recurring_payment']);
        $request['donor_type'] = (int)!empty($request['donor_type']);
        $request['is_send_email'] = (int)!empty($request['is_send_email']);
        $request['want_recive_letters'] = (int)!empty($request['want_recive_letters']);

        //$request['password'] = Hash::make($request['password']);
        //$request['password'] = Hash::make($request['password_repeat']);

        $this->merge([
            'active' => $request['active'],
            'recurring_payment' => $request['recurring_payment'],
            'donor_type' => $request['donor_type'],
            'is_send_email' => $request['is_send_email'],
            'want_recive_letters' => $request['want_recive_letters'],
            'password' => $request['password'],
            'password_repeat' => $request['password_repeat'],
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
            //'country_id' => 'nullable|integer|exists:countries,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'sponsor_id' => 'required|string|unique:user_options,sponsor_id,' . $this->id . ',user_id',
            'password' => 'required_with:password_repeat|string|max:20|same:password_repeat|min:4',
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
            'name.required' => ' Введите Имя.',
            'name.string' => ' Введите Имя.',
            'email.required' => ' Введите Эл.почту.',
            'email.email' => 'Недейтвительная эл.почта',
            'email.unique' => 'Эл.почта уже используется',
            'sponsor_id.unique' => 'Спонсор уже используется',
            'password.required' => ' Введите Пароль.',
            'password.required_with' => ' Введите Пароль и Повторите Пароль.',
            'password_repeat.required' => ' Повторите Пароль.',
            'password.same' => 'Пароли не совпадают',
            'password.min' => 'Пароль должен быть не менее :min символ(ов)',
            'password.max' => 'Пароль должен быть не более :max символ(ов)',
            'password.string' => 'Неправильный формат',
            'email.max' => 'Эл.почту должен быть не более :max символ(ов)',
            'name.max' => 'Имя должен быть не более :max символ(ов)',
        ];
    }
}
