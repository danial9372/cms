<?php

namespace Cyaxaress\Page\Http\Requests;

 use Cyaxaress\Page\Models\Page;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageStatusRequest extends FormRequest
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
            "status" => ["required", Rule::in(Page::$statuses)],
            "id" => "required|exists:pages,id",
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
