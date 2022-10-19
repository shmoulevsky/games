<?php

namespace App\Modules\Common\Country\Requests;


use App\Modules\Common\Base\FormRequests\BaseFormRequest;
use Illuminate\Validation\Rule;

class CountryUpdateRequest extends  BaseFormRequest
{

    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('countries', 'id')],
            'name' => ['string', 'required'],
            'domain' => ['string', 'required'],
            'is_active' => ['integer', 'required'],
            'sort' => ['integer', 'required'],
            'iso' => ['string','required', 'max:10'],
            'languages' => ['required', 'array'],
        ];
    }

}
