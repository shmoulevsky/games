<?php

namespace App\Modules\Utils\Generator\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableHandleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'table' => ['required', 'string'],
            'columns'  => ['required', 'array'],
        ];
    }
}
