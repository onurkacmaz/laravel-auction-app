<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionApplication extends Model
{
    use HasFactory;

    protected $table = "auction_applications";
    protected $guarded = [];
}
