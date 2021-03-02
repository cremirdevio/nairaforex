<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasWallet;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasWallet, TwoFactorAuthenticatable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'phonenumber', 'email', 'password', 'referrer_id', 'referrer_settled', 'status',
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

    /**
     * The relations loaded with the class.
     *
     * @var array
     */
    protected $with = ['wallet'];

    // Recepients of transfer from admin
    public function deposits()
    {
        return $this->hasMany(Transfer::class);
    }

    // Transfers made by Admin
    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    // Withdrawal Requests
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    // Transactions for purchase of plans
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function portfolio()
    {
        return $this->belongsToMany(Trader::class, 'trader_user')->withPivot('amount', 'status', 'end_date', 'transaction_id')->withTimestamps();;
    }

    public function scopeSearch($query, $username)
    {
        $query->where('email', $username)->orWhere('username', $username);
    }

    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function alreadyAssign($trade)
    {
        $trades = $this->portfolio;

        foreach ($trades as $trade) {
            if ($trade->id == $trade->id) return true;
        }
        return false;
    }

    public function referrerNotSettled()
    {
        return (!is_null($this->referrer) && !$this->referrer_settled);
    }

    public function profileUncompleted()
    {
        return $this->status == 'profile';
    }
}