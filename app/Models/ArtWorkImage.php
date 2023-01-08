<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtWorkImage extends Model
{
    use HasFactory;

    protected $table = "art_work_images";
    protected $guarded = [];
    protected $with = [];

    public function artWork() {
        return $this->belongsTo(ArtWork::class);
    }
}
