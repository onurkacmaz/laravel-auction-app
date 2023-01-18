<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtWorkFavorite extends Model
{
    use HasFactory, HasOrder;

    protected $table = "art_work_favorites";
    protected $guarded = [];

    private string $orderBy = "created_at";
    private string $orderDirection = "desc";
}
