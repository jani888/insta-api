<?php

namespace App;

use App\Models\InstagramAccount;
use App\Models\UserInstagramAccountPivot;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'current_account_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['currentAccount'];

    public function accounts() {
        return $this->belongsToMany(InstagramAccount::class);
    }

    public function currentAccount() {
        return $this->belongsTo(InstagramAccount::class);
    }
}
