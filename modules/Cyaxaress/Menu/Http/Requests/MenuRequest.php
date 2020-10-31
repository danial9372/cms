<?php

namespace Cyaxaress\Menu\Http\Requests;

use Cyaxaress\Menu\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
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
            "priority" => 'nullable|numeric',
            'parent_id' => 'nullable|exists:menus,id',
            "target" => ["required", Rule::in(Menu::$targets)],
            "position" => ["required", Rule::in(Menu::$positions)],
            "status" => ["required", Rule::in(Menu::$statuses)],
        ];

        if (request()->method === 'PATCH') {
             $rules['slug'] = 'required|min:5|max:70|unique:menus,slug,' . request()->route('menu');
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            "title" => "عنوان",
            "priority" => "اولویت",
            "slug" => "عنوان انگلیسی",
            "parent_id" => "والد",
            "status" => "وضعیت انتشار",
            "position" => "موقعیت نمایش",
            "target" => "نحوه نمایش",
        ];
    }

}
