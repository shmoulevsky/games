<?php

namespace App\Modules\Admin\Page\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class PageCategory extends Model
{
    use HasFactory, NodeTrait;
}
