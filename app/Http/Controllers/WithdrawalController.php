<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;

use App\Services\TransactionService;

class WithdrawalController extends Controller
{
    protected $paginate_count = 15;

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
        $withdrawals = Withdrawal::where('user_id', auth()->id());
        if (request()->has('status')) {
            $withdrawals = $withdrawals->filterByStatus(request()->query('status'));
        }
        
        if (request()->has('duration')) {
            $withdrawals = $withdrawals->filterByDuration(request()->query('duration'));
        }

        $withdrawals = $withdrawals->simplePaginate($this->paginate_count)->withQueryString();
        return view('withdrawals', compact('withdrawals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        return view('withdraw', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:10.00', 'max:15000.00'],
        ]);

        $amount = $request->amount * 100;

        $user = auth()->user();

        if (!$user->isSufficient($amount)) {
            return back()->with('error', 'Insufficient Balance. Credit your wallet as soon as possible.');
        }
        
        $this->transactionService->makeWithdrawal($request);

        return back()->with('success', 'Your withdrawal is being processed. Processing lasts within 24 hours.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        // Cancelling a withdrawal request
        $this->transactionService->cancelWithdrawal($withdrawal);
        
        return back()->with('success', 'Your withdrawal request has been cancelled.');
    }

    public function settle(Withdrawal $withdrawal)
    {
        // Validates a transaction
        $withdrawal->update(['status' => 'succeed']);

        return back()->with('success', 'The transaction has been declared settled!');
    }

    public function close(Withdrawal $withdrawal)
    {
        // Closes a transaction
        $withdrawal->update(['status' => 'closed']);
        // return $transaction;

        return back()->with('success', 'The transaction has been closed!');
    }
}