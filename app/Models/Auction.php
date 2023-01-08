<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
{
    use HasFactory, HasOrder;

    public const PAGINATION_LIMIT = 10;

    protected $table = "auctions";
    protected $guarded = [];

    protected $with = ['artWorks'];

    protected string $orderBy = 'created_at';
    protected string $orderDirection = 'desc';

    public function artWorks(): HasMany {
        return $this->hasMany(ArtWork::class);
    }
}
