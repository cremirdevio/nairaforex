<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TraderUser extends Model
{
    use HasFactory;

    protected $table = 'trader_user';

    protected $with = ['trader'];

    protected $guarded = ['id'];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function trader() {
        return $this->belongsTo(Trader::class);
    }

    public function getGrowth($start_date) {
        $start = Carbon::parse($start_date);
        $end = Carbon::parse($this->end_date);
        $now = Carbon::now();
        
        $duration = $end->diffInDays($start);
        $now = Carbon::now();

        $length = $now->diffInDays($start);
        
        if ($length == 0) return 1;
        return ($length * 100/$duration);
    }

    public function isCompleted() {
        $now = Carbon::now();
        $end = Carbon::parse($this->end_date);
        return $now->gt($end);
    }

    public function isPaidOut() {
        return ($this->status == 'completed' && $this->isCompleted());
    }

    public function getAbsoluteReturns() {
        $returns = $this->trader->returns;
        // Dividede by 10000 since the amount is given in kobo
        $total = ($returns * $this->amount)/10000;
        return number_format($total, 2, '.', $sep = ',');
    }

}