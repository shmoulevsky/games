<?php

namespace App\Modules\Language\Resources;

use App\Modules\Common\Language\Services\LanguageService;
use App\Modules\Setting\Models\Settings;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LanguageValueCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $lanuages = $this->collection->groupBy('group')->mapWithKeys(function ($group, $key){

            if($key === 'admin') $key = 'menu_bar';

            foreach ($group as $item) {
                $values[$item->code] =  $item->translation;
            }
            return [$key => $values];
        });

        /*$setting = Settings::where('key', 'admin_bar')->first();

        if (isset($setting->json)) {
            $admin_bar = json_decode($setting->json, true);
            $lanuages['menu_bar'] = [];
            if(isset($admin_bar[LanguageService::getCurrent()])){
                $admin_bar = collect($admin_bar[LanguageService::getCurrent()]);
                $keyed = $admin_bar->mapWithKeys(function ($item, $key) {
                    return [str_replace('.', '_', $key) => $item];
                });
                $lanuages['menu_bar'] = $keyed->all();
            }else{
                //dump($admin_bar);
                //dump(LanguageService::getCurrent());
            }

        }*/

        return $lanuages;
    }
}
