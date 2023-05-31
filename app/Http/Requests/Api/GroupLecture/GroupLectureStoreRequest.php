<?php

namespace App\Http\Requests\Api\GroupLecture;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupLectureStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "study_plan" => "required|array|min:1",
            "study_plan.*.lecture_id" =>[
                'required',
                'numeric',
                Rule::exists('lectures','id')
            ],

            "study_plan.*.order" => [
                'required',
                'numeric',
            ]
        ];
    }
}
