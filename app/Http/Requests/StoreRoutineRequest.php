<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoutineRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],

            'exercises' => ['required', 'array', 'min:1'],
            'exercises.*.exercise_id' => ['required', 'exists:exercises,id'],
            'exercises.*.sequence' => ['required', 'integer'],
            'exercises.*.target_sets' => ['required', 'integer'],
            'exercises.*.target_reps' => ['required', 'integer'],
            'exercises.*.rest_seconds' => ['required', 'integer'],s
        ];
    }
}
