<?php

namespace App\Modules\Email\Repositories;

use App\Modules\Base\BaseRepository;
use App\Modules\Email\Models\Email;
use Illuminate\Support\Facades\DB;


class EmailRepository extends BaseRepository
{
    public function all($column = 'id', $dir = 'desc')
    {
        return Email::with(['templates' => function ($query) {
            $query->where('language_code','=', $this->currentLanguage);
        }])
            ->orderBy($column, $dir)
            ->get();
    }

    public function getById(?int $id) : ?Email
    {
        if((int)$id === 0) {
            return null;
        }
        return Email::find($id);
    }

    public function getByCode(string $code, string $language)
    {
        return DB::table('emails')
            ->select(
                'emails.id as id',
                'emails.variables as variables',
                'email_templates.title as title',
                'email_templates.template as template',
            )
            ->join('email_templates', function ($join) use ($language) {
                $join->on('emails.id', '=', 'email_templates.email_id')
                    ->where('email_templates.language_code','=', $language);
            })->where('emails.code', $code)->first();
    }
}


