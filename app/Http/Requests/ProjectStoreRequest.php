<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
            'start_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Het titel veld is verplicht.',
            'description.required' => 'Het beschrijving veld is verplicht.',
            'start_date.required' => 'De startdatum is verplicht.',
        ];
    }
}
