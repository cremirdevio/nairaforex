<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trader;
use App\Models\Testimonial;

class WelcomePageServer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $traders = Trader::all()->take(6);
        $testimonials = Testimonial::inRandomOrder()->get();
        
        return view('welcome', compact('traders', 'testimonials'));
    }
}