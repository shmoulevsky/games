<?php

namespace App\Console\Commands;

use App\Utils\Generator\Services\GeneratorService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class FreshDb extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fresh-db {type=prod}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear db, run migration, seeding and import db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = microtime(true);

        if(env('APP_DEBUG') !== true){
            $this->info("It\'s production. Can't fresh DB");
            return 0;
        }

        $tables = [
            //'currencies',
            'countries',
            'languages',
            'users',
            //'comments',
            //'countries_languages',
            //'email_templates',
            //'emails',
            //'languages_group',
            //'languages_values',
            'game_categories',
            'game_category_translations',
            'games',
            'game_translations',
            'page_categories',
            'page_category_translations',
            'pages',
            'page_translations',
            'article_categories',
            'article_category_translations',
            'articles',
            'article_translations',
            'settings',
            'urls',
            //'user_groups',
            'notification_types',
            'notifications',
            'notification_descriptions',
            'tags',
            'tag_translations',
            'taggables',
            'tags_categories',
            //'user_subscriptions',
            //'feedback',
            //'logs',
            ];

        Artisan::call('migrate:fresh');
        $this->info('Db migrated');


        switch ($this->argument('type')){
            case 'prod' : $prefix = 'games_table_';break;
        }


        foreach ($tables as $table){

            $path = config('utils.importDbPath').$prefix.$table.'.sql';
            $exist = file_exists($path);

            if($exist){
                DB::unprepared(file_get_contents(config('utils.importDbPath').$prefix.$table.'.sql', FILE_USE_INCLUDE_PATH));
                $this->info("Table {$table} has been imported");
            }

        }

        if (env('APP_DEBUG') === true) {
            $this->info("Local");
            //DB::table('countries')->where('id', 2)->update(['domain' => 'floniq.com']);
        }

        $time_elapsed_secs = microtime(true) - $start;
        $this->info("Time: ".$time_elapsed_secs." sec.");

        return 0;
    }
}
