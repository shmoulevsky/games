<?php

namespace App\Http\Controllers\V1\Pub\App;



use App\Modules\Admin\Tag\Services\TagService;
use App\Modules\Common\Language\Repositories\LanguageRepository;
use App\Modules\Common\Language\Services\LanguageService;
use App\Modules\Common\Url\Services\UrlService;
use App\Modules\Pub\Repositories\TagRepository;
use App\Modules\Pub\Resources\TagResource;
use Illuminate\Http\Request;

class TagController
{

    private TagRepository $tagRepository;
    private TagService $tagService;
    private UrlService $urlService;

    public function __construct(
        LanguageRepository $languageRepository,
        TagRepository $tagRepository,
        TagService $tagService,
        UrlService $urlService,
    )
    {
        $this->languageRepository = $languageRepository;
        $this->tagRepository = $tagRepository;
        $this->tagService = $tagService;
        $this->urlService = $urlService;
    }

    public function index(Request $request)
    {
        $language = LanguageService::getCurrent();
        $tags = $this->tagRepository->getByCategory(
            $request->category_id,
            $request->type,
            $language
        );

        return TagResource::collection($tags);
    }
}
