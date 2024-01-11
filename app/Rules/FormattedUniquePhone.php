<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class FormattedUniquePhone implements Rule
{
    protected $allowedCodes = [
        //'+77',
        '+374',
    ];

    protected $message;

    protected $except;

    public function __construct($except = null)
    {
        $this->except = $except;
    }

    /**
     * @param string $attribute
     * @param mixed $phone
     * @return bool
     */
    public function passes($attribute, $phone)
    {
        $parsedPhone = preg_replace('/[^0-9]/', '', $phone);

        $query = User::query();

        if ($this->except) {
            $query = $query->where('id', '!=', $this->except);
        }

        if ($query->where('phone', $parsedPhone)->exists()) {
            $this->message = __('Этот номер телефона уже зарегистрирован в системе.');
        }

        return is_null($this->message);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
