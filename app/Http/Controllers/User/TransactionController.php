<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $transactions = auth()->user()->transactions;

        $transactions = Transaction::mine()->desc()->simplePaginate(10);

        return view('user.transactions', compact('transactions'));
    }

    public function deposit()
    {
        return view('user.deposit');
    }

    public function withdrawal()
    {
        $user = auth()->user();
        return view('user.withdrawal', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:10.00', 'max:15000.00'],
        ]);

        $user = auth()->user();

        if (!$user->isSufficient($request->amount)) {
            return back()->with('error', 'Insufficient Balance. Credit your wallet as soon as possible.');
        }

        $this->transactionService->makeWithdrawal($request);

        return back()->with('success', 'Your withdrawal is being processed. Processing lasts within 24 hours.');
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function destroy(Transaction $transaction)
    {
        // Only failed transactions can be deleted
        // Soft Delete or Force Delete the transaction
    }
}
