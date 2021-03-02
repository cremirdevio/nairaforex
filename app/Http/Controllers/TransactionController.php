<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\TransactionService;

class TransactionController extends Controller
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
        $transactions = Transaction::query();
        if (request()->has('status')) {
            $transactions = $transactions->filterByStatus(request()->query('status'));
        }
        
        if (request()->has('duration')) {
            $transactions = $transactions->filterByDuration(request()->query('duration'));
        }
        
        $transactions = $transactions->simplePaginate($this->paginate_count)->withQueryString();
        return view('transactions', compact('transactions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        // Only failed transactions can be deleted
        // Soft Delete or Force Delete the transaction
    }
}