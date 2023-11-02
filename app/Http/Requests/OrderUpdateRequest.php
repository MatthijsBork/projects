<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'zipcode' => 'required|string',
            'place' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',

            'invoice-name' => 'required_without:invoice',
            'invoice-address' => 'required_without:invoice',
            'invoice-zipcode' => 'required_without:invoice',
            'invoice-place' => 'required_without:invoice',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Naam is verplicht.',
            'address.required' => 'Adres is verplicht.',
            'zipcode.required' => 'Postcode is verplicht.',
            'place.required' => 'Plaats is verplicht.',
            'telephone.required' => 'Telefoonnummer is verplicht.',
            'email.email' => 'E-mail moet een E-mail zijn!.',
            'email.required' => 'E-mail is verplicht.',
            'invoice-name.required_without' => 'Naam is verplicht.',
            'invoice-address.required_without' => 'Adres is verplicht.',
            'invoice-zipcode.required_without' => 'Postcode is verplicht.',
            'invoice-place.required_without' => 'Plaats is verplicht.',
        ];
    }
}
