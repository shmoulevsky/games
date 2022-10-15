<?php

namespace App\Modules\Security\Mail;

use App\Models\User;
use App\Modules\Mail\Services\MailService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;
    /**
     * @var string
     */
    protected $code;

    public function failed($e)
    {
        throw new \Exception('Failed to send password reset email, please try again.');
    }

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->view('emails.reset-password')->with([
            'link' => request()->getHttpHost().'/auth/reset/'.$this->code
        ])
            ->subject('Reset password')
            ->from(MailService::getDefaultFrom());

    }
}
