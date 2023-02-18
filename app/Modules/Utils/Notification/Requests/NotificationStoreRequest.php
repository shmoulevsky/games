<?php

namespace App\Modules\Utils\Notification\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class NotificationStoreRequest extends  FormRequest
{

    public function rules(): array
    {
        return [
            'is_active' => ['nullable','integer'],
            'interval' => ['nullable',Rule::in(Duration::get())],
            'frequency' => ['nullable', 'integer'],
            'delay' => ['nullable', 'integer'],
            'count' => ['nullable', 'integer'],
            'channels' => ['required', 'array'],
            'groups' => ['required', 'array'],
            'typeId' => ['required', 'integer', Rule::exists('notification_types', 'id')],
            'descriptions' => ['required', 'array'],
        ];
    }
}
