<?php

namespace Cyaxaress\Setting\Http\Requests;

use Cyaxaress\Setting\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|min:5|max:70',
            'slug' => 'required|min:5|max:70',
            "body" => 'required|min:5|max:1500',
            "meta_description" => 'nullable|min:5|max:200',
            "meta_title" => 'nullable|min:5|max:70',
            "status" => ["required", Rule::in(Setting::$statuses)],
            "banner_id" => "required|mimes:". config('mediaFile.MediaTypeServices.image.extensions'),
        ];

        if (request()->method === 'PATCH') {
            $rules['banner_id'] = "nullable|mimes:". config('mediaFile.MediaTypeServices.image.extensions');
            $rules['slug'] = 'required|min:5|max:70|unique:Settings,slug,' . request()->route('Setting');
        }

        return $rules;
    }
    public function attributes()
    {
        return [
            "title" => "عنوان",
            "slug" => "عنوان انگلیسی",
            "body" => "توضیحات",
            "status" => "وضعیت انتشار",
            "banner_id" => "بنر",
            "meta_description" => "متا دسکریپشن [سئو]",
            "meta_title" => " متا تایتل [سئو] ",
        ];
    }

}
