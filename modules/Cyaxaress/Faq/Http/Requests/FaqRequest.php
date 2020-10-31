<?php

namespace Cyaxaress\Faq\Http\Requests;

use Cyaxaress\Faq\Models\Faq;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FaqRequest extends FormRequest
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
            'question' => 'required|min:5|max:500',
            'answer' => 'required|min:5|max:500',
            "faq_category_id" => "nullable|exists:faq_categories,id",
            "status" => ["required", Rule::in(Faq::$statuses)],
        ];

    }

    public function attributes()
    {
        return [
            "faq_category_id" => "دسته بندی",
            "question" => "سوال",
            "answer" => "پاسخ",
            "status" => "وضعیت انتشار",
        ];
    }

}
