<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtWorkImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "art_work_images";
    protected $guarded = [];
    protected $with = [];

    public function artWork() {
        return $this->belongsTo(ArtWork::class);
    }
}
