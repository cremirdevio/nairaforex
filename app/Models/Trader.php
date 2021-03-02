<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Trader extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function investors()
    {
        return $this->belongsToMany(User::class, 'trader_user')->withPivot('amount', 'transaction_id', 'status', 'end_date')->withTimestamps();;
    }

    public function isAvailable()
    {
        return $this->status == 'open';
    }

    public function getDuration() {
        return "$this->duration $this->duration_";
    }

    public function getDurationInDays() {
        $a = $this->duration;
        $b = $this->duration_;

        $dur = 1;
        switch ($b) {
            case 'days':
                $dur = $a*1;
                break;

            case 'weeks':
                $dur = $a*7;
                break;

            case 'months':
                $dur = $a*30;
                break;

            case 'years':
                $dur = $a*365;
                break;
            
            default:
                break;
        }

        return $dur;
    }

    public function getFlagAttribute() {
        return 'Flag';
    }

    public function getNationalityAttribute($value) {
        return $value;
    }
    
    public function getTotalReturns($amount) {
        // Dividede by 10000 since the amount is given in kobo
        $total = ($this->returns * $amount)/10000;
        return number_format($total, 2, '.', $sep = ',');
    }

    public function getGrowth($start_date) {
        $duration = $this->getDurationInDays();
        $start = Carbon::parse($start_date);
        $now = Carbon::now();

        $length = $now->diffInDays($start);
        
        if ($length == 0) return 1;
        return ($length * 100/$duration);
    }

    public function getEndDate($start_date) {
        $start = Carbon::parse($start_date);
        $end = $start->addDays(30);
        
        return $end;
    }

    public function getThumbnail() {
        $default =  'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjAgMTIwIj48cGF0aCBmaWxsPSIjRjFDMDJDIiBkPSJNOTkgMTIySDIxdi0xM2MwLTExIDktMjAgMjAtMjBoMzhjMTEgMCAyMCA5IDIwIDIwdjEzeiIvPjxwYXRoIGQ9Ik03OSA5MWM5LjkgMCAxOCA4LjEgMTggMTh2MTFIMjN2LTExYzAtOS45IDguMS0xOCAxOC0xOGgzOG0wLTJINDFjLTExIDAtMjAgOS0yMCAyMHYxM2g3OHYtMTNjMC0xMS05LTIwLTIwLTIweiIvPjxwYXRoIGZpbGw9IiNGRkYiIGQ9Ik02MCA5OC42Yy00LjkgMC04LjktNC04LjktOC45Vjc1LjljMC00LjkgNC04LjkgOC45LTguOXM4LjkgNCA4LjkgOC45djEzLjhjMCA0LjktNCA4LjktOC45IDguOXoiLz48cGF0aCBkPSJNNjAgNjljMy44IDAgNi45IDMuMSA2LjkgNi45djEzLjhjMCAzLjgtMy4xIDYuOS02LjkgNi45LTMuOCAwLTYuOS0zLjEtNi45LTYuOVY3NS45YzAtMy44IDMuMS02LjkgNi45LTYuOW0wLTJjLTQuOSAwLTguOSA0LTguOSA4Ljl2MTMuOGMwIDQuOSA0IDguOSA4LjkgOC45czguOS00IDguOS04LjlWNzUuOWMwLTQuOS00LTguOS04LjktOC45eiIvPjxjaXJjbGUgZmlsbD0iI0ZGRiIgY3g9Ijg2IiBjeT0iNTkiIHI9IjYiLz48cGF0aCBkPSJNODYgNjZjLTMuOSAwLTctMy4xLTctN3MzLjEtNyA3LTcgNyAzLjEgNyA3LTMuMSA3LTcgN3ptMC0xMmMtMi44IDAtNSAyLjItNSA1czIuMiA1IDUgNSA1LTIuMiA1LTUtMi4yLTUtNS01eiIvPjxwYXRoIGZpbGw9IiNGRkYiIGQ9Ik0zMyAyOXYyNC4xYy0yLjguNS01IDIuOS01IDUuOSAwIDMuMSAyLjQgNS43IDUuNCA2IDIuMiAxMi41IDEzLjEgMjIgMjYuMiAyMmguOEM3NS4xIDg3IDg3IDc1LjcgODcgNjAuNFYyOUgzM3oiLz48cGF0aCBkPSJNODUgMzF2MjkuNEM4NSA3NC4yIDc0LjIgODUgNjAuNCA4NWgtLjhjLTEyIDAtMjIuMi04LjYtMjQuMi0yMC40LS4yLS45LS45LTEuNi0xLjgtMS42LTIuMS0uMi0zLjYtMS45LTMuNi00IDAtMiAxLjQtMy42IDMuMy0zLjkgMS0uMiAxLjctMSAxLjctMlYzMWg1MG0yLTJIMzN2MjQuMWMtMi44LjUtNSAyLjktNSA1LjkgMCAzLjEgMi40IDUuNyA1LjQgNiAyLjIgMTIuNSAxMy4xIDIyIDI2LjIgMjJoLjhDNzUuMSA4NyA4NyA3NS43IDg3IDYwLjRWMjl6Ii8+PHBhdGggZmlsbD0iI0ZGRiIgZD0iTTU2IDc4Yy03LjcgMC0xNC02LjMtMTQtMTQiLz48cGF0aCBkPSJNNTYgNzljLTguMyAwLTE1LTYuNy0xNS0xNSAwLS42LjQtMSAxLTFzMSAuNCAxIDFjMCA3LjIgNS44IDEzIDEzIDEzIC42IDAgMSAuNCAxIDFzLS40IDEtMSAxeiIvPjxjaXJjbGUgY3g9IjU1IiBjeT0iNTUiIHI9IjIiLz48Y2lyY2xlIGN4PSI3NCIgY3k9IjU1IiByPSIyIi8+PHBhdGggZmlsbD0iI0ZGRiIgZD0iTTY1IDY2YzIuMiAwIDQtMS44IDQtNHMtMS44LTQtNC00di03Ii8+PHBhdGggZD0iTTY1IDY3Yy0uNiAwLTEtLjQtMS0xcy40LTEgMS0xYzEuNyAwIDMtMS4zIDMtM3MtMS4zLTMtMy0zYy0uNiAwLTEtLjQtMS0xdi03YzAtLjYuNC0xIDEtMXMxIC40IDEgMXY2LjFjMi4zLjUgNCAyLjUgNCA0LjkgMCAyLjgtMi4yIDUtNSA1eiIvPjxwYXRoIGZpbGw9IiMwMDZBREQiIGQ9Ik04OSAyN2MxLjcgMCAzLTEuMyAzLTN2LThINDhjLTMuMyAwLTYgMi43LTYgNmgtNWMtNSAwLTkgNC05IDl2MjFjMCAzLjMgMi43IDYgNiA2VjQxYzAtMyAyLjMtNS42IDUuMi01LjlDNDMuNiA0Mi43IDUzLjkgNDggNjYgNDhjMTYgMCAyOS05LjQgMjktMjFoLTZ6Ii8+PHBhdGggZD0iTTM0IDU5Yy0zLjkgMC03LTMuMS03LTdWMzFjMC01LjUgNC41LTEwIDEwLTEwaDQuMWMuNS0zLjQgMy40LTYgNi45LTZoNDRjLjYgMCAxIC40IDEgMXY4YzAgLjctLjIgMS40LS41IDJIOTVjLjYgMCAxIC40IDEgMSAwIDEyLjEtMTMuNSAyMi0zMCAyMi0xMS44IDAtMjIuNC01LTI3LjMtMTIuOC0yLjEuNS0zLjcgMi41LTMuNyA0Ljh2MTdjMCAuNi0uNCAxLTEgMXptMy0zNmMtNC40IDAtOCAzLjYtOCA4djIxYzAgMi40IDEuNyA0LjQgNCA0LjlWNDFjMC0zLjUgMi42LTYuNSA2LjEtNi45LjQgMCAuOC4xIDEgLjVDNDQuNCA0Mi4xIDU0LjYgNDcgNjYgNDdjMTUgMCAyNy4yLTguNCAyOC0xOWgtNWMtLjYgMC0xLS40LTEtMXMuNC0xIDEtMWMxLjEgMCAyLS45IDItMnYtN0g0OGMtMi44IDAtNSAyLjItNSA1IDAgLjYtLjQgMS0xIDFoLTV6Ii8+PC9zdmc+';
        
        if (isset($this->thumbnail)) {
            return asset('storage/'.$this->thumbnail);
        }

        return $default;
    }

    public function getFlag() {
        return asset('img/flags/'.strtolower($this->nationality).'.svg');
    }

    public function getCountry() {
        return config('countries')[strtoupper($this->nationality)];
    }
    
}