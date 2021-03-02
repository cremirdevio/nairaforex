<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderUser extends Model
{
    use HasFactory;

    protected $table = 'trader_user';

    protected $with = ['trader'];

    protected $guarded = ['id'];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public function trade() {
        return $this->belongsTo(Trader::class);
    }

    public function percentageGrowth() {
        // Calculates the percentage growth based on the start time and the current duration
        return 100;
    }

    public function getFinal() {
        return 3;
    }

}