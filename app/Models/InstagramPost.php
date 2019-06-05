<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramPost extends Model
{
    protected $guarded = [];

    public function account() {
        return $this->belongsTo(InstagramAccount::class, 'instagram_account_id', 'id');
    }
}
