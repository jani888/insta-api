<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InstagramAccount extends Model {

    public $incrementing = false;

    protected $guarded = [];

    public function hashtags() {
        return $this->belongsToMany(Hashtag::class);
    }

    public function getFollowersFormattedAttribute() {
        return number_format($this->followers->first()->value);
    }

    public function getFollowersChangeAttribute($days = 7) {
        return number_format($this->followers()->where('created_at', '<=', Carbon::now()->subDays($days))->first()->value ?? 0);
    }
    
    public function followers() {
        return $this->hasMany(InstagramFollower::class)->orderByDesc('created_at');
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
