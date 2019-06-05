<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramAccount extends Model
{
    protected $guarded = [];

    public $incrementing = false;

    public function hashtags() {
        return $this->belongsToMany(Hashtag::class);
    }
}
