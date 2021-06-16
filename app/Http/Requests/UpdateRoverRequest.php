<?php

namespace App\Http\Requests;

use App\Rules\ValidCommandString;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoverRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if(is_string($this->commandString)){
            $this->merge([
                'commandString' => strtoupper(str_replace(" ", "", $this->commandString)),
            ]);
        }
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
