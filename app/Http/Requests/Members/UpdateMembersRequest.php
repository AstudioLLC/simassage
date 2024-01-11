<?php

namespace App\Http\Requests\Members;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateMembersRequest extends FormRequest
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
            $request['url'] = !empty($request['title'][$this->urlLang]) ? to_url($request['title'][$this->urlLang]) : null;
        }
        $request['active'] = (int)!empty($request['active']);

        $this->merge([
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
            'title' => 'required|array',
            'title.' . $this->urlLang => 'required|string',
//            'department_ids' => 'required|array|max:255',
            'imageBig' => 'nullable|image|mimes:jpg,jpeg,webp,png',
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
            'title.required' => 'Введите название.',
            'title.*.required' => 'Введите название на всех языках ',
            'url.required' => 'Введите URL или подставьте галочку "сгенерировать автоматический".',
            'url.is_url' => 'Неправильный URL.',
            'url.unique' => 'URL уже используется.',
            'url.not_in_routes' => 'URL уже используется.',
            'url.min' => 'URL должен содержать мин. 3 символов.',
        ];
    }
}
