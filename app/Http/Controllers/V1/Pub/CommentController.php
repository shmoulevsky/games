<?php

namespace App\Http\Controllers\V1\Pub;




use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Repositories\LanguageRepository;
use App\Modules\Common\Language\Services\LanguageService;
use App\Modules\Pub\Comment\DTO\CommentDTO;
use App\Modules\Pub\Comment\Repositories\CommentRepository;
use App\Modules\Pub\Comment\Resources\CommentResource;
use App\Modules\Pub\Comment\Services\CommentService;
use App\Modules\Pub\Statistic\CommentStatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController
{

    private CommentRepository $commentRepository;
    private CommentService $commentService;
    private CommentStatService $commentStatService;

    public function __construct(
        CommentRepository $commentRepository,
        CommentService $commentService,
        CommentStatService $commentStatService
    )
    {

        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
        $this->commentStatService = $commentStatService;
    }

    public function show(Request $request)
    {
        $languageId = LanguageService::getCurrent();
        $comments = $this->commentRepository->getByEntity(
            $request->entity_id,
            $request->entity_type,
            $languageId
        );

        return CommentResource::collection($comments);
    }

    public function store(Request $request)
    {
        $countryId = CountryService::getCurrent();
        $languageId = LanguageService::getCurrent();
        $userId = Auth::id();

        $dto = new CommentDTO(
            $request->name,
            $request->email,
            $request->comment,
            $userId,
            $request->entity_id,
            $request->entity_type,
            $countryId,
            $languageId
        );

        $this->commentService->store($dto);
        $this->commentStatService->handle($request->entity_id, $request->entity_type, $languageId);

        return response()->json(['status' => 'ok']);
    }

}
