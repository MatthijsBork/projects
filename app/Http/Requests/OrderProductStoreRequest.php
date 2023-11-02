<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderProductStoreRequest extends FormRequest
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
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Kies een product',
            'product_id.integer' => 'Kies een product',
            'product_id.exists' => 'Product niet gevonden, herlaad de pagina en probeer opnieuw',
            'amount.required' => 'Verplicht',
            'amount.integer' => 'Er ging iets mis, herlaad de pagina en probeer opnieuw',
        ];
    }
}
