<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BidLog extends Model
{
    use HasFactory, SoftDeletes, HasOrder;

    public const PAGINATION_LIMIT = 10;

    private string $orderBy = "created_at";
    private string $orderDirection = "desc";

    protected $table = "bid_logs";
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function artWork(): BelongsTo
    {
        return $this->belongsTo(ArtWork::class);
    }

    public function getBidsWithoutThis() {
        return $this->whereNot('user_id', $this->user_id)->where('art_work_id', $this->art_work_id);
    }
}
