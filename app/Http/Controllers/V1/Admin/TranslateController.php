<?php

namespace App\Http\Controllers\V1\Admin;


use App\Modules\Common\Translate\Services\YandexTranslateService;
use Illuminate\Http\Request;

class TranslateController
{
    private YandexTranslateService $yandexTranslateService;

    public function __construct(
        YandexTranslateService $yandexTranslateService
    )
    {
        $this->yandexTranslateService = $yandexTranslateService;
    }

    public function translate(Request $request)
    {
        $translations = [];
        $result = [];
        $source = $request->source;
        $language = $request->language;

        $text = array_column($source, 'text');

        switch ($request->type){
            case 'yandex' : $translations = $this->yandexTranslateService->translate($text, $language); break;
        }

        foreach ($source as $key => $sourceItem){
            $result[] = ['key' => $sourceItem['key'], 'text' => $translations[$key]];
        }


        return response()->json(['result' => $result]);
    }
}
