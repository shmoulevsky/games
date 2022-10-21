<?php

namespace App\Modules\Utils\Generator\Tests;

use App\Modules\Utils\Generator\Repositories\TableRepository;
use App\Modules\Utils\Generator\Services\ListGeneratorService;
use Tests\TestCase;

class TableGeneratorTest extends TestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->repository = app()->make(TableRepository::class);
        $this->service = app()->make(ListGeneratorService::class);
    }

    public function test_table_generate()
    {
        $columns = $this->repository->getColumns('users');
        $needColumns = ['id', 'name', 'phone'];

        dump($this->service->handle($columns, $needColumns, 'users'));

        $this->assertTrue(true);
    }
}
