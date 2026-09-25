<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'departament_id' => ['required', 'exists:departaments,id'],
            'title'          => ['required', 'string', 'max:300'],
            'requester_name' => ['required', 'string', 'max:255'],
            'priority'       => ['required', 'in:Baixa,Média,Alta,Urgente'],
            'description'    => ['required', 'string', 'max: 1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'departament_id.required' => 'Selecione o departamento correspondente.',
            'title.required'          => 'O título do chamado é obrigatório.',
            'requester_name.required' => 'O nome do solicitante é obrigatório.',
            'description.required'    => 'A descrição do problema é obrigatória',
        ];
    }
}
