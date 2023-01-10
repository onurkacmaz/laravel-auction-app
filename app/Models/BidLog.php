<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BidLog extends Model
{
    use HasFactory, SoftDeletes, HasOrder;

    private string $orderBy = "created_at";
    private string $orderDirection = "desc";

    protected $table = "bid_logs";
    protected $guarded = [];
}
