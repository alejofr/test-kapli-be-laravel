<?php

namespace App\Http\Requests\Book;

use App\Traits\RemoveDecoratorRules;

class UpdatePutBook extends StorePostBook
{
    use RemoveDecoratorRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->removeRules(parent::rules(), ['required']);
    }
}
