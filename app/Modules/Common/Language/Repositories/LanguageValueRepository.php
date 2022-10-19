<?php

namespace App\Modules\Common\Language\Repositories;

class LanguageValueRepository extends BaseRepository
{
    protected $modelClass = LanguagesValues::class;

    public function getByLanguageCode($code)
    {
        return $this->model->select('code','group', 'translation')
            ->where('language_id', function ($query) use ($code){
                $query->from('languages')
                    ->select('id')
                    ->where('code' , $code);
            })->get();
    }
}
