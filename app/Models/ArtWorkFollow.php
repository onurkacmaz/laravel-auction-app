<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtWorkFollow extends Model
{
    use HasFactory, HasOrder;

    protected $table = "art_work_follows";
    protected $guarded = [];

    private string $orderBy = "created_at";
    private string $orderDirection = "desc";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
