<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class StorePostAuthor extends FormRequest
{
    public static string $name;
    public static int    $age;
    public static string $bibliography;

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
            'name' => ['required','max:120', 'string'],
            'age'  => ['required', 'integer'],
            'bibliography' => ['required', 'string'],
        ];
    }
}
