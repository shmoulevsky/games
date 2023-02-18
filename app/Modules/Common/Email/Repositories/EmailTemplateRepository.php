<?php

namespace App\Modules\Email\Repositories;

use App\Modules\Base\BaseRepository;
use App\Modules\Email\Models\EmailTemplate;


class EmailTemplateRepository extends BaseRepository
{
    public function find(string $languageCode, int $emailId)
    {
        return EmailTemplate::where([
            ['language_code', $languageCode],
            ['email_id', $emailId],
        ])->first();
    }
}
