<?php

namespace App\Http\Controllers\User;

use App\Models\Stock;
use App\Services\StockService;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    protected $stockService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StockService $stockService)
    {
        $this->middleware('auth');
        $this->stockService = $stockService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->load('wallet');
        return view('user.dashboard', compact('user'));
    }

    public function profile_update(Request $request) {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required', 'string', 'max:11'],
            'bankname' => ['required', 'string', 'max:255'],
            'banknumber' => ['required', 'string', 'max:10'],
            'accountname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        // Update the profile and Wallet Address if necessary
        // :profile update
        $user = Auth::user();
        $user->update($request->except(['bankname', 'banknumber', 'accountname']));

        // :wallet update
        $user->wallet()->update($request->only(['bankname', 'banknumber', 'accountname']));

        if ($user->profileUncompleted()) {
            $user->update(['status' => 'active']);
            return back()->with('success', 'Your profile has been updated successfully and you can now perform other transactions.');
        }
        return back()->with('success', 'Your profile has been updated successfully!');
    }

    public function password_update(Request $request) {
        $user = Auth::user();

        // Validate the old password
        $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
        ]);

        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Incorrect Password.');
        }

        // If old password is correct, the proceed to validate the new password
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Update the users password
        $new_hash = Hash::make($request->old_password);
        $user->password = $new_hash;
        $user->save();

        return back()->with('success', 'Your password has been changed successfully. Ensure you secure it properly.');
    }

    public function portfolio() {
        $stocks = auth()->user()->portfolio;

        $total_share_price = 0;
        foreach ($stocks as $stock) {
            $price = $stock->get_current_price();
            $unit = $stock->pivot->unit;

            $sub_share = round($unit * $price);
            $total_share_price += $sub_share;
        }

        $growthRate = array();
        $growthRate['all_time'] = $this->stockService->allTimeIncrease($stocks);
        $growthRate['past_seven_days'] = $this->stockService->allTimeIncrease($stocks, Carbon::now()->subDays(7));
        $growthRate['past_24_hours'] = $this->stockService->allTimeIncrease($stocks, Carbon::now()->subHours(24));

        return view('user.portfolio', compact('stocks', 'total_share_price', 'growthRate'));
    }

    public function sellShares() {
        $stocks = auth()->user()->portfolio;
        return view('sell_shares', compact('stocks'));
    }

    public function portfolio_single(Stock $stock) {
        $currentEvent = $stock->current();
        $dataset = $stock->getChartData();

        $label = $dataset['label'];
        $data = $dataset['data'];

        $post = $stock->message_body;

        return view('user.user-stock', compact('stock', 'currentEvent', 'label', 'data', 'post'));
    }
}
