<?php

namespace App\Http\Requests;

use App\Rules\DateNotGreaterThanCurrent;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'description' => 'required|max:191',
            'date' => ['required', 'date', new DateNotGreaterThanCurrent],
            'value' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'insira a descriação.',
            'description.max' => 'caracteres excedidos.',
            'date.required' => 'insira a data',
            'value.required' => 'insira o valor.',
            'value.min' => 'O valor não pode ser negativo.',
        ];
    }
}
