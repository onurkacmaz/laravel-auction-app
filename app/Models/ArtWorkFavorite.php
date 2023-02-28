<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtWorkFavorite extends Model
{
    use HasFactory, HasOrder;

    protected $table = "art_work_favorites";
    protected $guarded = [];

    private string $orderBy = "created_at";
    private string $orderDirection = "desc";

    protected $with = ['artwork'];

    public function artwork(): BelongsTo
    {
        return $this->belongsTo(ArtWork::class, 'art_work_id', 'id');
    }
}
