<?php

namespace App\Modules\Admin\Game\Repositories;

use App\Modules\Admin\Game\Models\Game;
use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Property\Models\Property;
use App\Modules\Common\Property\Models\PropertyValue;
use Illuminate\Support\Facades\DB;

class GameRepository extends BaseRepository
{
    protected $modelClass = Game::class;

    public function all($column = 'id', $dir = 'desc', $filter = [], $count = 10)
    {
        return $this->model->select(
            'games.*',
            'game_translations.title as title',
            'urls.url as url'
        )
            ->join('game_translations', function ($query) {
                $query->on('game_translations.game_id','=', 'games.id');
                $query->where('game_translations.language_id','=', $this->currentLanguage);
            })->leftJoin('urls', function ($join) {
                $join->on('games.id', '=', 'urls.entity_id');
                $join->on('urls.language_id','=', DB::raw($this->currentLanguage));
                $join->on('urls.entity','=', DB::raw('game'));
            })
            ->orderBy($column, $dir)
            ->get();
    }

    public function getFullById(?int $id)
    {
        $game = $this->model
            ->with('translations')
            ->where('id', $id)
            ->first();

        $properties = Property::select('id')
            ->with('translations:title,property_id,language_id')->whereIn('id', function ($query) use ($id){
            $query->from('games_properties')
                ->select('property_id')
                ->where('game_id', $id)
                ->get();
        })
            ->get()
            ->transform(function ($property) {
                $property->translationsKeyed = $property->translations->keyBy('language_id');
                return $property;
            });


        $propertyValues = PropertyValue::whereIn('property_id', $properties->pluck('id'))
            ->get()
            ->groupBy('property_id')
            ->map(function ($property){
                return $property->keyBy('language_id');
            })
            ->toArray();

        //dd($propertyValues);

        $properties->transform(function ($property) use ($propertyValues){
            $property->translations->map(function ($trans) use ($property, $propertyValues){
               $trans->value =  $propertyValues[$property->id][$trans->language_id]['json'] ?? $propertyValues[$property->id][$trans->language_id]['value'] ?? '';
            });
            return $property;
        });



        $game->properties = $properties;
        return $game;
    }

}
