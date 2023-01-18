<?php

namespace App\Models;

use App\Http\Traits\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtWorkFollow extends Model
{
    use HasFactory, HasOrder;

    protected $table = "art_work_follows";
    protected $guarded = [];

    private string $orderBy = "created_at";
    private string $orderDirection = "desc";
}
