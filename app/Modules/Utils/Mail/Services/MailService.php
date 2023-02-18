<?php

namespace App\Modules\Utils\Mail\Services;

use App\Modules\Mail\DTO\MailDTO;
use App\Modules\Mail\Mail\CommonEmail;
use App\Modules\Utils\Mail\Repositories\MailTemplateRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailService
{
    private const DEFAULT_EMAIL = 'shmoulevskye@gmail.com';
    private const ADMIN_EMAIL = 'shmoulevskye@gmail.com';

    public  const TYPES = [
        'register' => 'register',
        'restore' => 'restore',
        'feedback' => 'feedback',
        'contact' => 'contact',
        'comment' => 'comment',
        'notify' => 'notify',
    ];

    public static function getDefaultFrom()
    {
        return DB::table('settings')->where('group', 'smtp')
            ->where('key','mail_username')->first()?->value ?? self::DEFAULT_EMAIL;
    }

    public static function getType(string $key)
    {
        return self::TYPES[$key];
    }

    public static function getAdminEmail()
    {
        return self::ADMIN_EMAIL;
    }

    public function send(
        string $email,
        string $language,
        string $code,
        array $data
    ) : void
    {
        $repository = app()->make(MailTemplateRepository::class);
        $template = $repository->getByCode($code, $language);

        $mailDTO = new MailDTO(
            $template->title,
            $template->template,
            explode(',', $template->variables),
            $data
        );

        Mail::mailer('smtp')->to($email)->send(new CommonEmail($mailDTO->getBody(), $mailDTO->subject));

    }

    public function sendCommon(
        string $email,
        string $title,
        string $template,
        array $data
    ) : void
    {

        $mailDTO = new MailDTO(
            $title,
            $template,
            ['name','lastname'],
            $data
        );

        Mail::mailer('smtp')->to($email)->send(new CommonEmail($mailDTO->getBody(), $mailDTO->subject));

    }



}
