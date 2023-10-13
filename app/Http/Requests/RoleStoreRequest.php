<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
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
            'name' => 'required|string|max:32|unique:roles,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Het naam veld is verplicht.',
            'name.max' => 'Naam mag maximaal 32 tekens lang zijn',
            'name.unique' => 'Er is al een rol met deze naam',
        ];
    }
}
