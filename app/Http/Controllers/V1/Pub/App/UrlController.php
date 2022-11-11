<?php

namespace App\Http\Controllers\V1\Pub\App;

use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Common\Base\Factories\RepositoryFactory;
use App\Modules\Common\Language\Repositories\LanguageRepository;
use App\Modules\Common\Url\Repositories\UrlRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UrlController
{
    private LanguageRepository $languageRepository;
    private UrlRepository $urlRepository;

    public function __construct(
        LanguageRepository $languageRepository,
        UrlRepository $urlRepository
    )
    {
        $this->languageRepository = $languageRepository;
        $this->urlRepository = $urlRepository;
    }

    public function index(Request $request)
    {
        $url = urldecode($request->url);
        $params = ParamListDTO::fromRequest($request, 'created_at', 'desc');

        $url = $this->urlRepository->getByUrl($url);
        $repository = RepositoryFactory::make($url->entity);
        $page = $repository->getPage($url->entity_id);
        $list = [];
        $code = 200;
        $filter = [];

        if($url->is_list){
            $type = json_decode($url->list, true);
            $repositoryList = RepositoryFactory::make($type[0]);

            if($url->is_root === 0){
                $filter['category_id'] = $page->id;
            }

            $list = $repositoryList->getPageList(
                $params->getSort(),
                $params->getDir(),
                $filter,
                $params->getCount()
            );
        }

        return response()->json([
            'id' => $url->id,
            'type' => $url->entity,
            'page' => $page,
            'list' => $list,
        ], $code);

    }
}
