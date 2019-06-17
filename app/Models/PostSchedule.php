<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostSchedule extends Model
{
    protected $table = "posting_schedule";

    protected $guarded = [];

    protected $casts = [
        'post_at'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
