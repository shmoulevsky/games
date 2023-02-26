<?php

namespace App\Http\Controllers\V1\Pub\User;

use App\Modules\Pub\Statistic\StatService;
use Illuminate\Http\Request;

class StatisticController
{
    public function store(Request $request)
    {
        $statService = new StatService();
        $statService->handle($request->type, $request->id);
    }
}
