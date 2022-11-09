<?php

namespace App\Http\Controllers\V1\Pub\App;

use App\Modules\Common\Language\Repositories\LanguageRepository;
use App\Modules\Common\Settings\Repositories\SettingsRepository;
use Illuminate\Http\Request;

class AppController
{
    private LanguageRepository $languageRepository;
    private SettingsRepository $settingsRepository;

    public function __construct(
        LanguageRepository $languageRepository,
        SettingsRepository $settingsRepository,
    )
    {
        $this->languageRepository = $languageRepository;
        $this->settingsRepository = $settingsRepository;
    }

    public function index(Request $request)
    {
        $languages = $this->languageRepository->getAll();
        $info = $this->settingsRepository->getByGroup('common');

        return response()->json([
            'languages' => $languages,
            'top_menu' => json_decode($info['top_menu']->json)
        ]);
    }
}
