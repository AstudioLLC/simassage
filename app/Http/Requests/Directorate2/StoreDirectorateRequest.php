<?php

namespace App\Http\Requests\Directorate2;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreDirectorateRequest extends FormRequest
{

    /**
     * @var string
     */
    protected $urlLang;

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

        $this->urlLang = Language::getUrlLang();
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
        if (!empty($request['url'])) {
            $request['url'] = to_url(lower_case($request['url']));
        } else {
            $request['url'] = !empty($request['name'][$this->urlLang]) ? to_url($request['name'][$this->urlLang]) : null;
        }
        $request['active'] = (int)!empty($request['active']);



        $this->merge([
            'url' => $request['url'],
            'active' => $request['active'],
            // 'department_id' => $request['department_id'],
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required', // Add this line to validate each element in the "name" array
            'image' => 'nullable|image|mimes:jpg,jpeg,webp,png',
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
            'name.required' => 'Введите название.',
            'url.required' => 'Введите URL или подставьте галочку "сгенерировать автоматический".',
            'url.is_url' => 'Неправильный URL.',
            'url.unique' => 'URL уже используется.',
            'url.not_in_routes' => 'URL уже используется.',
            'url.min' => 'URL должен содержать мин. 3 символов.',
        ];
    }
}
