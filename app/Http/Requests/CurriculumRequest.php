<?php

namespace App\Http\Requests;

use App\Http\Enums\Education;
use Illuminate\Foundation\Http\FormRequest;

class CurriculumRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'position' => 'required|string',
            'education' => 'required|in:' . implode(',', array_column(Education::cases(), 'value')),
            'observations' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:1024',
        ];
    }
}
