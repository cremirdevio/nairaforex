<?php

if (!function_exists('to_money_format')) {
    function to_money_format($value) {
        $value /= 100;
        return number_format($value, 0, '.', $sep = ',');
    }
}

if (!function_exists('to_decimal')) {
    function to_decimal($value) {
        $value /= 100;
        return number_format($value, 2, '.', $sep = '');
    }
}

if (!function_exists('to_2_dp')) {
    function to_2_dp($value) {
        $value *= 100;
        if ($value < 0)
            return number_format($value, 2, '.', $sep = '');
        else
            return '+'.number_format($value, 2, '.', $sep = '');
    }
}

if (!function_exists('signed_money')) {
    function signed_money($value) {
        $value /= 100;
        if ($value < 0) {
            $value = $value * -1;
            return '-$'.number_format($value, 2, '.', $sep = ',');
        }
        else
            return '+$'.number_format($value, 2, '.', $sep = ',');
    }
}

if (!function_exists('to_naira')) {
    function to_naira($value) {
        $value /= 100;
        $check = ($value - floor($value))  * 100;
        if ($check > 0)
            return number_format($value, 2, '.', $sep = ',');
        else
            return number_format($value, 0, '.', $sep = ',');
    }
}

if (!function_exists('to_abs')) {
    function to_abs($value) {
        return ($value >= 0)?'+'.$value:$value;
    }
}

if (!function_exists('event_tag')) {
    function event_tag($stock) {
        $stage = $stock->stage;

        if ($stage == 'home')
            return 'success';
        elseif ($stage == 'away')
            return 'dark';
        else
            return 'warning';
    }
}

if (!function_exists('link_state')) {
    function link_state($path, $check) {
        return (strpos($path, $check))?'active':'';
    }
}

if (!function_exists('status')) {
    function status($state) {
        if ($state == 'succeed')
            return 'success';
        elseif ($state == 'closed')
            return 'danger';
        else
            return 'warning';
    }
}

if (!function_exists('to_date')) {
    function to_date($date) {
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    }
}

if (!function_exists('get_value')) {
    function get_value($unit, $price) {
        return ($unit * $price);
    }
}

if (!function_exists('credit_deposit')) {
    function credit_deposit($transaction) {
        return $transaction->type == config('transaction.deposit') and $transaction->recipient == auth()->id();
    }
}

if (!function_exists('to_rating')) {
    function to_rating($rating) {
        $html = '';
        $full = floor($rating/2);
        $left = fmod($rating,2);

        $i = 1;
        for (; $i <= $full; $i++) { 
            $html .= '<i class="fa fa-star uk-text-warning"></i>';
        }
        
        $done = false;
        for (; $i <= 5; $i++) { 
            if (!$done && $left > 0) {
                $html .= '<i class="fa fa-star-half-o uk-text-warning"></i>';
                $done = true;
            } else {
                $html .= '<i class="fa fa-star-o uk-text-warning"></i>';
            }
        }

        return $html;
    }
}