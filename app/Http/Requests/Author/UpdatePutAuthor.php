<?php

namespace App\Http\Requests\Author;

use App\Traits\RemoveDecoratorRules;

class UpdatePutAuthor extends StorePostAuthor
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
