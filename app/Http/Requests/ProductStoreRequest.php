<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|decimal:0,2',
            'stock' => 'required|int',
            'vat' => 'required|int',
            'image' => 'image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Het titel veld is verplicht.',
            'title.max' => 'Het titel veld mag maximaal 255 karakters bevatten.',
            'description.required' => 'Het beschrijving veld is verplicht.',
            'price.required' => 'De prijs is verplicht.',
            'stock.required' => 'De voorraad is verplicht.',
            'stock.int' => 'De voorraad moet een geheel getal zijn.',
            'vat.required' => 'Het BTW-percentage is verplicht.',
            'vat.int' => 'Het BTW-percentage moet een geheel getal zijn.',
            'image_name.string' => 'Het bestandsnaam veld moet een tekst zijn.',
            'image.size' => 'Het bestand mag maximaal 2 MB zijn.',
        ];
    }
}
