<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Stock;
use App\Models\StockUser;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\StockService;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    protected $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \App\Models\User::find(6);
        $stock = $user->portfolio[0];

//        $date = Transaction::find($stock->pivot->transaction_id)->created_at;
//        $date = Carbon::now()->subDays(7);
//        $date = Carbon::now()->subHours(24);
//
//        $beginning = $stock->pivot->created_at;
//        dd($date->et(Carbon::parse($beginning)));
//        return $stock;

//        $event = Event::for($stock)->fromDate($date)->orderAscend()->first();
//        return $this->stockService->allTimeIncrease($stock);
//        return $this->stockService->pastSevenDays($stock, $date);
//        return $this->stockService->past24Hours($stock);

        $portfolios = StockUser::all();
        $transactions = array();
        foreach ($portfolios as $portfolio) {
            $transaction = Transaction::find($portfolio->transaction_id);
            $transactions[] = $transaction;
            $portfolio->update(['created_at' => $transaction->created_at]);
        }

        return $portfolios;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
