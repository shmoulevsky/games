<?php

namespace App\Http\Controllers\V1\Pub\App;

use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Common\Base\Factories\RepositoryFactory;
use App\Modules\Common\Language\Repositories\LanguageRepository;
use App\Modules\Common\Url\Models\Url;
use App\Modules\Common\Url\Repositories\UrlRepository;
use Illuminate\Http\Request;


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

        if(empty($url)){
            return response()->json([
                'id' => null,
                'type' => Url::NOT_FOUND,
                'page' => null,
                'list' => [],
            ]);
        }

        $repository = RepositoryFactory::make($url->entity);

        $page = $repository->getPage($url->entity_id);
        $list = [];
        $filter = [];

        if($url->is_list){
            $type = json_decode($url->list, true);
            $repositoryList = RepositoryFactory::make($type[0]);

            if($url->is_root === 0 && $url->entity != Url::TAG){
                $filter['category_id'] = $page->id;
            }

            if($url->entity === Url::TAG){
                $url->entity = $page->type;
                $filter['id'] = $repositoryList->getByTag($page->id, $type[0]);
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
        ]);

    }
}
