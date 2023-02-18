<?php

namespace App\Modules\Utils\Notification\Channels;

use App\Modules\Utils\Notification\Interfaces\ChannelInterface;
use App\Modules\Utils\Notification\Jobs\SendEmailJob;
use App\Modules\Utils\Notification\Services\TemplateService;
use Illuminate\Support\Carbon;

class EmailChannel implements ChannelInterface
{

    /**
     * @var TemplateService
     */
    private $templateService;

    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    public function send($recipients, $admins, $notification)
    {

        $bcc = $this->getBcc($admins);
        $now = Carbon::now();

        foreach ($recipients as $recipient){

            $info = $this->templateService->make($recipient, $notification);

            if(empty($recipient->email)) continue;

            SendEmailJob::dispatch($recipient, $recipient->email, $bcc, $info->title, $info->body, $notification)
                ->onQueue('default')
                ->onConnection('database')
                ->delay($now->addSeconds($notification->delay));
        }
    }

    private function getBcc($admins)
    {
        if(empty($admins)) return null;

        return $admins->pluck('email')->toArray();
    }

    public function sendAdmin($recipients, $admins, $notification)
    {
        foreach ($recipients as $recipient){
            foreach ($admins as $admin) {

                $info = $this->templateService->make($recipient, $notification);
                SendEmailJob::dispatch($recipient, $admin->email, [], $info->title, $info->body, $notification)
                    ->onQueue('default')
                    ->onConnection('database')
                    ->delay(Carbon::now()->addSeconds($notification->delay));
            }

        }
    }
}
