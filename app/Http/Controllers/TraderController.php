<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trader;
use App\Services\TransactionService;

class TraderController extends Controller
{
    protected $paginate_count = 12;

    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traders = Trader::simplePaginate($this->paginate_count);
        return view('traders', compact('traders'));
    }


    /**
     * Subscribe to a trader.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Trader $trader)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:100000', 'max:300000000'],
        ]);

        $user = auth()->user();

        if (!$user->isSufficient($request->amount)) {
            return back()->with('error', 'Insufficient Balance. Credit your wallet as soon as possible.');
        }

        $this->transactionService->buyShares($request, $trader);

        return back()->with('success', 'You have successfully assigned the capital to the trader.');
    }

}