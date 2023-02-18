<?php

namespace App\Modules\Email\Services;




use App\Modules\Email\Models\EmailTemplate;

class EmailTemplateService
{

    public function delete(int $emailId)
    {
        EmailTemplate::where('email_id', $emailId)->delete();
    }
}
