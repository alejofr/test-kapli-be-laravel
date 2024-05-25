<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StorePostBook extends FormRequest
{
    public static int $author_id;
    public static string $title;
    public static int $stars;
    public static string $overview;

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
            'title' => ['required','max:120', 'string'],
            'stars'  => ['required', 'integer', 'numeric', 'min:1', 'max: 5'],
            'overview' => ['required', 'string'],
        ];
    }
}
