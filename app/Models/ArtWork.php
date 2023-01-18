<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtWork extends Model
{
    use HasFactory, HasOrder, SoftDeletes;

    public const PAGINATION_LIMIT = 10;

    protected $table = "art_works";

    protected $guarded = [];

    protected $with = ['images', 'artist', 'bids'];

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

    public function bids(): HasMany {
        return $this->hasMany(BidLog::class);
    }

    public function getHighestBid(): Model|BidLog|null {
        return $this->bids()->first();
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(ArtWorkFavorite::class);
    }

    public function favorite(): ArtWorkFavorite|null|Model {
        return $this->favorites()->where('user_id', auth()->id())->first();
    }

    public function follows(): HasMany {
        return $this->hasMany(ArtWorkFollow::class);
    }

    public function followed(): ArtWorkFollow|Model|null {
        return $this->follows()->where('user_id', auth()->id())->first();
    }
}
