<?php

namespace App\Http\Requests\Directorate2;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateDirectorateRequest extends FormRequest
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
            'name' => 'required|array|max:255',
            'description' => 'required|array' ,
            'image' => 'nullable|image|mimes:jpg,jpeg,webp,png',
            'position' => 'required|array|max:255',
        ];
    }

}
