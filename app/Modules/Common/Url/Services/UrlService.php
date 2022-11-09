<?php

namespace App\Modules\Common\Url\Services;


use App\Modules\Common\Base\Services\BaseService;
use App\Modules\Common\Url\Models\Url;
use App\Modules\Common\Url\Repositories\UrlRepository;

class UrlService extends BaseService
{
    protected $modelClass = Url::class;
    protected $repositoryClass = UrlRepository::class;

    public function createOrUpdate($dto) : Url
    {
        $url = $this->getItem($dto->id);
        $url->entity = $dto->entity;
        $url->entity_id = $dto->entityId;
        $url->language_id = $dto->languageId;
        $url->url = $dto->url;
        $url->save();

        return $url;
    }
}
