<?php

namespace App\Modules\Utils\Notification\Jobs;


use App\Modules\Utils\Mail\Mail\CommonEmail;
use App\Modules\Utils\Notification\Services\NotificationMessageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $subject;
    protected $template;
    protected $notification;
    private $user;
    private $bcc;
    private $body;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        $user,
        $email,
        $bcc,
        $subject,
        $body,
        $notification
    )
    {
        $this->subject = $subject;
        $this->user = $user;
        $this->bcc = $bcc;
        $this->email = $email;
        $this->body = $body;
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::mailer('smtp')
            ->to($this->email)
            ->bcc($this->bcc)
            ->send(new CommonEmail($this->body, $this->subject));

        NotificationMessageService::store($this->body, $this->user->id, $this->notification->id);
    }
}
