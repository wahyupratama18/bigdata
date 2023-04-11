<?php

namespace App\Http\Requests;

use App\Models\Course;
use App\Models\Expert;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'array', 'min:1'],
            'name.*' => ['required', 'string', 'max:255', Rule::unique(Course::class, 'name')],
            'expert_id' => ['required', 'array'/* , 'same:name' */],
            'expert_id.*' => ['required', 'array', 'min:1'],
            'expert_id.*.*' => ['required', 'string', 'max:255', Rule::exists(Expert::class, 'id')],
        ];
    }
}
