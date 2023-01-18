<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimitSetting extends Model
{
    use HasFactory, HasOrder;

    public const PAGINATION_LIMIT = 10;

    protected $table = 'limit_settings';
    protected $guarded = [];

    private string $orderBy = 'created_at';

    private string $orderDirection = 'desc';
}
