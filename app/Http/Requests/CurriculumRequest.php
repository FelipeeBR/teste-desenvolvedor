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
            'file' => 'required|file|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',
            
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Informe um email válido.',
            
            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.string' => 'O telefone deve ser um texto.',
            
            'position.required' => 'O campo cargo é obrigatório.',
            'position.string' => 'O cargo deve ser um texto.',
            
            'education.required' => 'O campo escolaridade é obrigatório.',
            'education.in' => 'Selecione uma escolaridade válida.',
            
            'observations.string' => 'As observações devem ser um texto.',
            
            'file.required' => 'O arquivo do currículo é obrigatório.',
            'file.file' => 'O arquivo deve ser um arquivo válido.',
            'file.mimetypes' => 'O arquivo deve ser do tipo PDF, DOC ou DOCX.',
            'file.max' => 'O arquivo não pode ter mais de 1MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'file' => 'arquivo',
            'email' => 'e-mail',
        ];
    }
}
