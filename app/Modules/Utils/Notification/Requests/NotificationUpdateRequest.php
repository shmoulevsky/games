<?php

namespace App\Modules\Utils\Notification\Requests;

use App\Modules\TariffPlan\Entities\Duration;
use App\Modules\Url\Entities\EntityGroups;
use App\Modules\Url\Rules\SameUrlRule;
use App\Modules\Utils\Validation\Rules\ExistAtLeastOne;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationUpdateRequest extends  FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('notifications', 'id')],
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
