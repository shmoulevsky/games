<?php

namespace App\Http\Controllers\V1\Pub\App;


use App\Modules\Admin\Tag\Repositories\TagRepository;
use App\Modules\Admin\Tag\Services\TagService;
use App\Modules\Common\Language\Repositories\LanguageRepository;
use App\Modules\Common\Language\Services\LanguageService;
use Illuminate\Http\Request;

class TagController
{

    private TagRepository $tagRepository;
    private TagService $tagService;

    public function __construct(
        LanguageRepository $languageRepository,
        TagRepository $tagRepository,
        TagService $tagService,
    )
    {
        $this->languageRepository = $languageRepository;
        $this->tagRepository = $tagRepository;
        $this->tagService = $tagService;
    }

    public function index(Request $request)
    {
        $language = LanguageService::getCurrent();
        $rawTags = $this->tagRepository->getByCategory(
            $request->category_id,
            $request->type,
            $language
        );

        $tags = $this->tagService->make($rawTags);

        return response()->json(['tags' => $tags]);
    }
}
