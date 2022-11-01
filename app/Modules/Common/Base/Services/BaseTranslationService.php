<?php

namespace App\Modules\Common\Base\Services;



abstract class BaseTranslationService extends BaseService
{
    protected string $modelTranslationClass;
    protected string $repositoryTranslationClass;
    protected string $linkProperty;

    public $repositoryTranslation;
    public $modelTranslation;


    public function __construct()
    {
        parent::__construct();
        if($this->modelTranslationClass) {
            $this->modelTranslation = app()->make($this->modelTranslationClass);
        }

        if($this->repositoryTranslationClass) {
            $this->repositoryTranslation = app()->make($this->repositoryTranslationClass);
        }

    }

    public function storeTranslations(array $translations, $item)
    {
        foreach ($translations as $lang => $translationItem) {

            $translation = $this->repositoryTranslation->find(
                $lang,
                $item->id
            );

            if(empty($translation)){
                $translation = $this->modelTranslation;
                $translationItem[$this->linkProperty] = $item->id;
                $translationItem['language_id'] = $lang;
                $translation->create($translationItem);
                continue;
            }

            $translation->update($translationItem);
        }

    }
}
