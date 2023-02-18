<?php

namespace App\Modules\Utils\Notification\Services;

use App\Modules\Utils\Notification\DTO\DataDTO;
use Illuminate\Support\Facades\DB;

class TemplateService
{

    public function make($recipient, $notification)
    {
        $variables = $this->getVariables($notification);
        $template = $this->getTemplate($recipient, $notification);
        $subject = $template->name;
        $body = $template->description;
        $data = $this->getData($recipient, $variables);

        foreach ($variables as $variable){
            $pattern = '#'.$variable.'#';
            $body = str_ireplace($pattern, $data[$variable], $body);
        }

        return new DataDTO($subject, $body);
    }

    private function getTemplate($recipient, $notification)
    {
        return $notification->descriptions->where('language_id', (int)$recipient->language)->first();
    }

    private function getVariables($notification)
    {
        return json_decode($notification->variables, true);
    }

    private function getData($recipient, $variables)
    {
        $data = [];

        foreach ($variables as $variable){

            if(isset($recipient->additional[$variable])){
                $data[$variable] =  $recipient->additional[$variable];
                continue;
            }

            $data[$variable] = $recipient?->$variable ?? '';
        }

        return $data;
    }
}
