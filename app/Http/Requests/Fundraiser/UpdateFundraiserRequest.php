<?php

namespace App\Http\Requests\Fundraiser;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateFundraiserRequest extends FormRequest
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
        $request['unlimit'] = (int)!empty($request['unlimit']);

        $this->merge([
            'url' => $request['url'],
            'active' => $request['active'],
            'unlimit' => $request['unlimit'],
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
            'child_id' => 'nullable|exists:childrens,id',
            'title' => 'required|array',
            'title.' . $this->urlLang => 'required|string',
            'url' => 'required|string|unique:fundraisers,url,' . $this->id . '|min:3|is_url',
            'imageBig' => 'nullable|image|mimes:jpg,jpeg,webp,png',
            'imageSmall' => 'nullable|image|mimes:jpg,jpeg,webp,png',
            'cost' => 'required|numeric||min:0',
            'collected' => 'nullable|numeric||min:0'
            //'title.*' => 'required|string|max:255',
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
            'title.*.required' => 'Введите название.',
            'url.required' => 'Введите URL или подставьте галочку "сгенерировать автоматический".',
            'url.is_url' => 'Неправильный URL.',
            'url.unique' => 'URL уже используется.',
            'url.not_in_routes' => 'URL уже используется.',
            'url.min' => 'URL должен содержать мин. 3 символов.',
        ];
    }
}
