<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PostSchedule extends Model
{

    const MAX_ATTEMPTS = 5;

    protected $table = "posting_schedule";

    protected $guarded = [];

    const UPDATED_AT = null;

    protected $casts = [
        'post_at'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function scopeShouldPost($query) {
        $query->where('post_at', '<=', Carbon::now())->where('attempts', '<=', self::MAX_ATTEMPTS);
    }
}
