<?php

namespace App\Http\Controllers\V1\Admin;


use App\Modules\Admin\Game\DTO\GameDTO;
use App\Modules\Admin\Game\Repositories\GameRepository;
use App\Modules\Admin\Game\Requests\GameStoreRequest;
use App\Modules\Admin\Game\Resources\GameCollection;
use App\Modules\Admin\Game\Resources\GameResource;
use App\Modules\Admin\Game\Services\GameService;
use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Services\LanguageService;
use App\Modules\Common\Settings\Repositories\SettingsRepository;
use App\Modules\Common\Settings\Resources\SettingsKeyResource;
use App\Modules\Common\Settings\Services\SettingsService;
use Illuminate\Http\Request;

class SettingsController
{
    private SettingsRepository $settingsRepository;
    private SettingsService $settingsService;

    public function __construct(
        SettingsRepository $settingsRepository,
        SettingsService $settingsService
    )
    {
        $this->settingsRepository = $settingsRepository;
        $this->settingsService = $settingsService;
    }

    public function show($key)
    {
        $settings = $this->settingsRepository->getByKey($key);
        return new SettingsKeyResource($settings);
    }


    public function update(Request $request)
    {


    }

    public function updateByKey(string $key, Request $request)
    {
        $settings = $this->settingsService->updateByKey($key, $request->json);
        return response()->json(['settings' => $settings]);
    }


}
