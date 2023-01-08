<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArtWork extends Model
{
    use HasFactory, HasOrder;

    protected $table = "art_works";

    protected $guarded = [];

    protected $with = ['images', 'artist'];

    protected string $orderBy = 'created_at';

    protected string $orderDirection = 'desc';

    public function images(): HasMany {
        return $this->hasMany(ArtWorkImage::class);
    }

    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}
