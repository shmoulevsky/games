<?php

namespace App\Modules\Utils\Mail\Mail;

use App\Models\User;
use App\Modules\Utils\Mail\Services\MailService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommonEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;
    /**
     * @var string
     */
    protected $link;

    public function failed($e)
    {
        throw new \Exception('Failed to send email, please try again.');
    }

    public function __construct(string $html, string $subject)
    {
        $this->html = $html;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->view('emails.common')->with([
            'html' => $this->html
        ])
            ->subject($this->subject)
            ->from(MailService::getDefaultFrom());

    }
}
