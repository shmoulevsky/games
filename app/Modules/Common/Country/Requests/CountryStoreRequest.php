<?php

namespace App\Modules\Common\Country\Requests;


use App\Modules\Common\Base\FormRequests\BaseFormRequest;

class CountryStoreRequest extends  BaseFormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'domain' => ['string', 'required'],
            'is_active' => ['integer', 'required'],
            'sort' => ['integer', 'required'],
            'iso' => ['string','required', 'unique:countries','max:10'],
            'languages' => ['required', 'array'],
        ];
    }

}
