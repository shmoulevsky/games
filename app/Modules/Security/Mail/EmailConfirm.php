<?php

namespace App\Modules\Security\Mail;

use App\Models\User;
use App\Modules\Mail\Services\MailService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirm extends Mailable
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
        throw new \Exception('Failed to send password reset email, please try again.');
    }

    public function __construct(User $user,string $link)
    {
        $this->user = $user;
        $this->link = $link;
    }

    public function build()
    {
        return $this->view('emails.mail')->with([
            'link' => $this->link
        ])
            ->subject('Verification your Email')
            ->from(MailService::getDefaultFrom());

    }
}
