<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
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
            'intro' => 'required|string',
            'content' => 'required|string',
            'publication_date' => 'required|date',
            'category_id' => 'required|integer|exists:categories,id',
            'image_name' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Het titel veld is verplicht.',
            'title.max' => 'Titel mag niet langer zijn dan 255 tekens.',
            'intro.required' => 'Het introductie veld is verplicht.',
            'content.required' => 'Het content veld is verplicht.',
            'publication_date.required' => 'Publiceerdatum is verplicht.',
            'category_id.required' => 'Categorie is verplicht.',
        ];
    }
}
