<?php

namespace App\Http\Requests;

use App\Rules\ValidDirection;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoverRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'direction' => strtoupper($this->direction),
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
            'x' => [
                'required',
                'numeric',
            ],
            'y' => [
                'required',
                'numeric',
            ],
            'direction' => [
                'required',
                'string',
                new ValidDirection(),
            ],
        ];
    }
}
