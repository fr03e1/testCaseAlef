<?php

namespace App\Http\Requests\Api\StudyPlan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudyPlanUpdateRequest extends FormRequest
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
            "study_plan.*.group_id" => [
                'required',
                'numeric',
                Rule::exists('groups','id'),
            ],

            "study_plan.*.lecture_id" =>[
                'required',
                'numeric',
                Rule::exists('lectures','id'),
            ],

            "study_plan.*.order" => [
                'required',
                'numeric',
                'unique:groups_lectures,order,' . $this->order . ',id,lecture_id,' . $this->study_plan[0]['lecture_id'],
            ]
        ];
    }
}
