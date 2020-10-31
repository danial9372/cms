<?php

namespace Cyaxaress\Menu\Http\Requests;

use Cyaxaress\Menu\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuStatusRequest extends FormRequest
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
        return [
            "status" => ["required", Rule::in(Menu::$statuses)],
            "id" => "required|exists:Menus,id",
        ];

    }

    public function attributes()
    {
        return [
            "status" => "وضعیت انتشار",
            "id" => "صفحه",
        ];
    }

}
