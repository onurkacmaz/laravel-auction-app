<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtWorkGroup extends Model
{
    use HasFactory, HasOrder;

    public const PAGINATION_LIMIT = 10;

    protected string $orderBy = 'order';

    protected string $orderDirection = 'asc';

    protected $table = 'art_work_groups';

    protected $guarded = [];
}
