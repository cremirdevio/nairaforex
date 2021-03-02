<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

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

    // User who made the transfer
    public function creditor()
    {
        return $this->belongsTo(User::class);
    }

    // User who is receiving the transfer
    public function recepient()
    {
        return $this->belongsTo(User::class, 'recipient');
    }

    public function scopeDesc($query)
    {
        $query->orderBy('created_at', 'desc');
    }

    public function scopePending($query)
    {
        $query->where('status', 'pending');
    }
    
    public function scopeMine($query)
    {
        $id = auth()->id();
        $query->where('user_id', $id)->orWhere('recipient', $id);
    }

    public function is_mine()
    {
        return $this->user_id == auth()->id();
    }
}
