<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trader;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $traders = Trader::all()->count();
        $testimonials = Testimonial::all()->count();
        $users = User::all()->count();
        $transactions = Transaction::all()->count();
        $withdrawals = Withdrawal::all()->count();
        $pending_withdrawals = Withdrawal::pending()->count();

        return view('admin.dashboard', compact('traders', 'testimonials', 'transactions', 'withdrawals', 'pending_withdrawals', 'users'));
    }

    public function roles() {
        $roles = Role::with('users')->get();


        if (count($roles) == 0) {
//            Create the necessary roles
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'funder']);
            Role::create(['name' => 'compiler']);
            Role::create(['name' => 'customer service']);
        }

        return view('admin.users-role', compact('roles'));
    }
}