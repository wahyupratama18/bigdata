<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'courses' => 'required|array',
            'courses.*' => ['required', 'integer', Rule::exists(Course::class, 'id')],
            'scores' => ['required', 'array'/* , 'same:courses' */],
            'scores.*' => ['required', 'string', Rule::in(array_keys(Course::SCORES))],
        ];
    }
}
