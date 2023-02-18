<?php

namespace App\Modules\Mail\DTO;

class MailDTO
{

    public $subject;
    public $body;
    public $template;
    public $variables;
    /**
     * @var array
     */
    private $data;

    public function __construct(
        string $subject,
        string $template,
        array $variables,
        array $data
    )
    {
        $this->subject = $subject;
        $this->template = $template;
        $this->variables = $variables;
        $this->data = $data;
    }

    public function getBody(?string $language = null)
    {
        $this->body = $this->template;
        foreach ($this->variables as $variable){

            $this->body = $this->replaceVariables($variable, $language);

        }
        return $this->body;
    }

    private function replaceVariables($variable, $language)
    {

        if(isset($this->data[$language][$variable]) && $language !== null){
            $this->body = str_ireplace('#'.$variable.'#', $this->data[$language][$variable], $this->body);
        }

        if(isset($this->data[$variable])){
            $this->body = str_ireplace('#'.$variable.'#', $this->data[$variable], $this->body);
        }

        return   $this->body = str_ireplace('#'.$variable.'#', '', $this->body);

    }
}
