<?php

namespace App\Http\Requests\Page;

use App\Models\Language;
use App\Models\Page;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePageRequest extends FormRequest
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
        $request['to_menu'] =(int)!empty($request['to_menu']);;
        $request['show_image'] = (int)!empty($request['show_image']);
        $request['to_top'] = (int)!empty($request['to_top']);
        $request['to_footer'] = (int)!empty($request['to_footer']);
        $request['active'] = (int)!empty($request['active']);
        $request['show_contact'] = (int)!empty($request['show_contact']);


        $this->merge([
            'id' => $this->route('id'),
            'parent_id' => $request['parent_id'] ?? null,
            'url' => $request['url'],
            'to_menu' => $request['to_menu'],
            'show_image' => $request['show_image'],
            'to_top' => $request['to_top'],
            'to_footer' => $request['to_footer'],
            'active' => $request['active'],
            'show_contact' => $request['show_contact'],
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
            //'url' => 'required|string|unique:pages,url,' . $this->id . '|min:3|not_in_routes|is_url',
            'url' => 'required|string|unique:pages,url,' . $this->id . '|min:3|is_url',
            'info_url' => 'nullable|string|min:3|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,webp,png',
            'icon' => 'nullable|image|mimes:jpg,jpeg,webp,png',
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
