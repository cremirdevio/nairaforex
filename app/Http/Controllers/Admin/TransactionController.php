<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Auth;

class TransactionController extends Controller
{
    protected $paginate_count = 15;

    protected $transactionService;

    public function __construct(TransactionService $transactionService) {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $transactions = Transaction::query();
        if (request()->has('status')) {
            $transactions = $transactions->filterByStatus(request()->query('status'));
        }
        
        if (request()->has('duration')) {
            $transactions = $transactions->filterByDuration(request()->query('duration'));
        }
        $transactions = $transactions->admin()->desc()->simplePaginate($this->paginate_count)->withQueryString();
        return view('admin.transactions', compact('transactions'));
    }

    public function settle(Transaction $transaction)
    {
        // Validates a transaction
        $transaction->update(['status' => 'succeed']);

        return back()->with('success', 'The transaction has been declared settled!');
    }

    public function close(Transaction $transaction)
    {
        // Closes a transaction
        $transaction->update(['status' => 'closed']);
        // return $transaction;

        return back()->with('success', 'The transaction has been closed!');
    }

    public function destroy(Transaction $transaction)
    {
        // Deletes a transaction
        return $transaction;
    }

    public function withdrawals() {
        $withdrawals = Transaction::with('user')->withdrawals()->pending()->desc()->simplePaginate(25);

        // Return the necessary view
        // return $withdrawals;
        return view('admin.admin-withdrawals', compact('withdrawals'));
    }

    public function adminTransferForm(Request $request) {
        // Return View for transferring
        $user = User::find(Auth::id());
        $transactions = $user->transactions()->hasRecipient()->admin()->desc()->get()->take(3);
        return view('admin.admin-transfer', compact('user', 'transactions'));
    }

    public function funderTransferForm() {
        // Return View for transferring
        $user = User::find(Auth::id());
        $transactions = $user->transactions()->hasRecipient()->funder()->desc()->get()->take(3);
        return view('admin.funder-transfer', compact('user', 'transactions'));
    }

    // Admin/Funder transfer logic
    public function transfer(Request $request) {
        if (!isset($request->role)) {
            return back()->with('error', 'Unauthorized access!');
        }

        $request->validate([
            'username' => ['required', 'string',  'max:255'],
            'amount' => ['required', 'numeric', 'min:1.00'],
        ]);

        $amount = $request->amount;
        $user = Auth::user();
        $recipient = User::search($request->username)->first();

        if (!$user->isSufficient($amount) && $request->role == 'funder') {
            return back()->with('error', 'Your wallet balance is insufficient for this transaction.');
        }

        if (!$recipient || $request->username == $user->username) {
            return back()->with('error', 'There is no such user with the username: ' .$request->username);
        }

        $this->transactionService->makeTransfer($request, $user, $recipient);

        $amount = to_naira($amount*100);
        return back()->with('success', 'You have successfully transferred ($) ' .$amount. ' to ' .$request->username);
    }

    public function generate($type) {
        switch ($type) {
            case 'transfer':
                $no = 'FMY'.time() .'TRF';
                break;
            case 'withdrawal':
                $no = 'FMY'.time() .'WTH';
                break;
            case 'investment':
                $no = 'FMY'.time() .'INV';
                break;
            default:
                $no = 'FMY-'.time() .'-ERR';
                break;
        }
        return $no;
    }
}