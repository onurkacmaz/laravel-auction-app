<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserArtWork extends Model
{
    use HasFactory, HasOrder;

    protected $table = 'user_art_works';
    protected $guarded = [];
    protected string $orderBy = 'created_at';
    protected string $orderDirection = 'desc';

    protected $with = ['artWork'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function artWork(): BelongsTo
    {
        return $this->belongsTo(ArtWork::class);
    }
}
