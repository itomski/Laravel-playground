<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start' => 'required|date|after:now',
            'end' => 'required|date|after:now',
            'customer_id' => 'required|integer|min:1',
            'vehicle_id' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'start.required' => 'Du musst das Datum richtig eingeben!',
            'start.date' => 'Das Startdatum muss das richtige Format haben!',
            'start.after' => 'Das Startdatum muss später sein als heute!',
            'end.required' => 'Das Enddatum muss auch da sein!'
        ];
    }

}
