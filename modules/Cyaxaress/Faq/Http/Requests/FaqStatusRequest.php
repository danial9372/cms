<?php

namespace Cyaxaress\Faq\Http\Requests;

use Cyaxaress\Faq\Models\Faq;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FaqStatusRequest extends FormRequest
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
            "status" => ["required", Rule::in(Faq::$statuses)],
            "id" => "required|exists:faqs,id",
        ];

    }

    public function attributes()
    {
        return [
            "status" => "وضعیت",
            "id" => "سوالات متداول",
        ];
    }

}
