<?php

namespace App\Modules\Common\Base\Services;

use App\Modules\Common\Base\DTO\DTOInterface;

interface BaseServiceInterface
{
    public function createOrUpdate(DTOInterface $dto);
}
