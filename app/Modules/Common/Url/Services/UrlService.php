<?php

namespace App\Modules\Common\Url\Services;


use App\Modules\Common\Base\Services\BaseService;
use App\Modules\Common\Url\Models\Url;
use App\Modules\Common\Url\Repositories\UrlRepository;

class UrlService extends BaseService
{
    const TYPES = [
        Url::ARTICLE_CATEGORY => Url::ARTICLE,
        Url::PAGE_CATEGORY => Url::PAGE,
        Url::GAME_CATEGORY => Url::GAME,
    ];

    protected $modelClass = Url::class;
    protected $repositoryClass = UrlRepository::class;
    private UrlPathService $urlPathService;

    public function __construct(UrlPathService $urlPathService)
    {
        parent::__construct();
        $this->urlPathService = $urlPathService;
    }

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

    public function getChildType(string $type)
    {
        return self::TYPES[$type];
    }

}
