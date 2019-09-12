<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function account(){
        return $this->belongsTo(InstagramAccount::class, 'instagram_account_id', 'id');
    }

    public function schedule() {
        return $this->hasOne(PostSchedule::class);
    }

    public function instagramPost() {
        return $this->belongsTo(InstagramPost::class);
    }
}
