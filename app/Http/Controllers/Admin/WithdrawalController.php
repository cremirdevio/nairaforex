<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\withdrawal;
use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Auth;

class WithdrawalController extends Controller
{
    protected $paginate_count = 15;

    protected $transactionService;

    public function __construct(TransactionService $transactionService) {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $withdrawals = Withdrawal::query();
        if (request()->has('status')) {
            $withdrawals = $withdrawals->filterByStatus(request()->query('status'));
        }
        
        if (request()->has('duration')) {
            $withdrawals = $withdrawals->filterByDuration(request()->query('duration'));
        }
        $withdrawals = $withdrawals->desc()->simplePaginate($this->paginate_count)->withQueryString();
        
        return view('admin.withdrawals', compact('withdrawals'));
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

    public function destroy(Withdrawal $withdrawal)
    {
        // Deletes a transaction
        return $withdrawal;
    }

}