<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskUpSertRequest extends FormRequest
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
        $rules = [];

        /*
         * Verifica se o método é do Tipo PUT para realizar a validação de update
         */
        if ($this->isMethod('PUT')) {
            $rules['id'] = 'required|exists:tasks,id';
        }

        /*
         * Mescla a validação de POST e PUT para aproveitamento de código, evitando criar um novo arquivo de validação apenas para o método update no TaskController
         */
        return array_merge($rules, [
            'nome' => 'required',
            'descricao' => 'nullable',
            'data_limite' => ['nullable', Rule::date()->format('d/m/Y H:i:s')]
        ]);
    }
}
