<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $guarded = [];

    public function posts() {
        return $this->belongsToMany(InstagramPost::class);
    }
}
