<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Filter;

class Transaction extends Model
{
    use HasFactory, Filter;

    protected $guarded = [
        'id',
    ];

    public function getDate()
    {
        return date('m/d/y', strtotime($this->created_at));
    }

    public function getTime()
    {
        return date('H:i:s', strtotime($this->created_at));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transfer_recipient() {
        return $this->belongsTo('App\Models\User', 'recipient');
    }

    public function portfolio()
    {
        return $this->hasOne(TraderUser::class);
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeReferralEarnings($query, $user)
    {
        return $query->where('type', 'referral');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeHasRecipient($query)
    {
        return $query->where('recipient', '!=', null);
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin')->where('user_id', auth()->id());
    }

    public function scopeNotAdmin($query)
    {
        return $query->where('role', 'user');
    }

    public function scopeFunder($query)
    {
        return $query->where('role', 'funder')->where('user_id', auth()->id());
    }

    public function scopeMine($query) {
        return $query->where('user_id', auth()->id())->orWhere('recipient', auth()->id());
    }
}