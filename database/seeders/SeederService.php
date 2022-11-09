<?php

namespace Database\Seeders;



use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SeederService
{
    public function make($table, $items, $isTimestamps = true)
    {
        foreach ($items as $item){

            $data = [];

            if($isTimestamps){
                $data['created_at'] = Carbon::now();
                $data['updated_at'] = Carbon::now();
            }

            foreach ($item as $key => $value){
                $data[$key] = $value;
            }

            DB::table($table)->insert($data);
        }
    }
}
