<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'accountname', 'bankname', 'banknumber', 'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //    public function setBalanceAttribute($value) {
    //        $this->attributes['balance'] = $value * 100;
    //    }
    //
    //    public function setBonusAttribute($value) {
    //        $this->attributes['bonus'] = $value * 100;
    //    }

    public function getBankName()
    {
        return config('banks')[$this->bankname];
    }

    public function getRawBankName()
    {
        return $this->banks[$this->bankname];
    }
}