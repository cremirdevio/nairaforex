<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filter;

class Withdrawal extends Model
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

    public function scopeDesc($query)
    {
        $query->orderBy('created_at', 'desc');
    }

    public function scopePending($query)
    {
        $query->where('status', 'pending');
    }
}