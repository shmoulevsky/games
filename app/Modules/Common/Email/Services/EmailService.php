<?php

namespace App\Modules\Email\Services;



use App\Modules\Base\BaseService;
use App\Modules\Email\DTO\EmailDTO;
use App\Modules\Email\Models\Email;
use App\Modules\Email\Models\EmailTemplate;
use App\Modules\Email\Repositories\EmailRepository;
use App\Modules\Email\Repositories\EmailTemplateRepository;
use Illuminate\Support\Facades\DB;

class EmailService extends BaseService
{
    protected $modelClass = Email::class;
    protected $repositoryClass = EmailRepository::class;

    private $emailRepository;
    private $emailTemplateRepository;
    private $emailTemplateService;

    public function __construct(
        EmailRepository         $emailRepository,
        EmailTemplateService    $emailTemplateService,
        EmailTemplateRepository $emailTemplateRepository
    )
    {
        parent::__construct();
        $this->emailRepository = $emailRepository;
        $this->emailTemplateRepository = $emailTemplateRepository;
        $this->emailTemplateService = $emailTemplateService;
    }

    public function createOrUpdate(EmailDTO $emailDTO) : Email
    {
        $email = $this->getEmail($emailDTO->id);

        DB::transaction(function () use ($emailDTO, $email){

            $email->code = $emailDTO->code;
            $email->variables = $emailDTO->variables;
            $email->save();

            foreach ($emailDTO->templates as $lang => $template){

                $emailTemplate = $this->emailTemplateRepository->find(
                    $lang,
                    $email->id
                );

                if(empty($emailTemplate)){
                    $emailTemplate = new EmailTemplate();
                    $emailTemplate->email_id = $email->id;
                }

                $emailTemplate->title = $template['title'];
                $emailTemplate->template = $template['template'];
                $emailTemplate->language_code = $lang;
                $emailTemplate->save();

            }

        });

        return $email;
    }


    private function getEmail($emailId)
    {
        $email = $this->emailRepository->getById($emailId);

        if($emailId > 0 && empty($email)){
            throw new \Exception("Email with id #{$emailId} not found");
        }

        if(empty($email)){
            $email = new Email();
        }

        return $email;
    }
}
