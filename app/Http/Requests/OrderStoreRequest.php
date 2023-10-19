<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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

        $invoiceFieldRules = $this->input('invoice')
            ? 'nullable|string'
            : 'required|string';

        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'zipcode' => 'required|string',
            'place' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|string',

            'invoice-name' => $invoiceFieldRules,
            'invoice-address' => $invoiceFieldRules,
            'invoice-zipcode' => $invoiceFieldRules,
            'invoice-place' => $invoiceFieldRules,
        ];
    }
}
