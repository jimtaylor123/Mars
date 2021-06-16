<?php

namespace App\Http\Requests;

use App\Rules\ValidCommandString;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoverRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'commandString' => strtoupper($this->commandString),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'commandString' => [
                'required',
                'string',
                new ValidCommandString(),
            ],
        ];
    }
}
