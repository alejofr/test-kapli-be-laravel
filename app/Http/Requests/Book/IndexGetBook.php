<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class IndexGetBook extends FormRequest
{
    public static int $author_id;

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
            'author_id'  => ['required', 'integer'],
        ];
    }
}
