<?php


namespace App\Services;


use App\Models\Trader;
use App\Models\TraderUser;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionService
{
    protected $role = 'user';
    const REFERRAL_RATE = 0.04;
    const REGISTRATION_BONUS = 3000;

//    ALl amounts must be converted to kobo before processing

    public  function makeWithdrawal(Request $request) {
        $amount = $request->amount * 100;
        $user = Auth::user();

        // Create Reference Code
        $ref = $this->createReference('withdrawal');

        $user->debit($amount);
        $user->refresh();

        $request->merge(['amount' => $amount, 'balance' => $user->balance(), 'reference' => $ref]);
        $withdrawal = Withdrawal::create($request->all());

        $user->transactions()->save($withdrawal);
    }

    public function buyShares(Request $request, Trader $trader) {
        $amount = $request->amount * 100;
        $user = Auth::user();

        $duration = $trader->getDurationInDays();

        // Check if the trader is available to be assigned
        // if (!$stock->canBeTraded()) {
        //     return back()->with('warning', 'Event is currently active. You can\'t trade this player at the moment.');
        // }
        // Create a buy transaction
        // Debit the user
        $ref = $this->createReference('buy');

        DB::beginTransaction();

        try {
            $user->debit($amount);
            $user->refresh();

            $request->merge(['amount' => $amount, 'type'=> 'invest', 'balance' => $user->balance(), 'reference' => $ref, 'status' => 'succeed']);

            $investment = Transaction::create($request->all());
            $user->transactions()->save($investment);

            // Users can assign a trader more than once exclusively
            // Add the share to the user's portfolio
            $user->portfolio()->attach($trader->id, ['transaction_id' => $investment->id, 'amount' => $amount, 'end_date' => Carbon::now()->addDays($duration)]);

        } catch (Throwable $e) {
            DB::rollback();
            return back()->with('error', 'An error occured!');
        }

        DB::commit();

        // Return a response to the user
        return redirect()->route('home')->with('success', 'You have successfully assigned the $trader->name to a balance of $amount Naira');
    }

    public function makePayout(TraderUser $trade) {
        $user = $trade->user;
        $amount = $trade->getAbsoluteReturnsRaw() * 100;

        
        DB::beginTransaction();

        try {
            // Credit the recipients wallet with the amount
            $user->credit($amount);

            // Change trade status
            $trade->update(['status' => 'completed']);
            
            // Create Reference Code
            $ref = $this->createReference('payout');

            // dd($request);
            $payout = Transaction::create(['amount' => $amount, 'type'=> 'payout', 'role' => 'user', 'balance' => $user->balance(), 'reference' => $ref, 'status' => 'succeed']);
            
            // Save users transaction
            $user->transactions()->save($payout);
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', 'An error occured!');
        }

        DB::commit();

    }

    public function makeTransfer(Request $request, User $sender, User $recipient) {
        $amount = $request->amount * 100;

        if ($sender->id == $recipient->id) return;

        if (isset($request->role)) {
            $role = $request->role;
        }
        
        DB::beginTransaction();

        try {
            // Debit users wallet with the amount (Only if the role is user or funder)
            if ($role == 'user' || $role == 'funder') {
                $sender->debit($amount);
                $sender->refresh();
            }
            // Credit the recipients wallet with the amount
            $recipient->credit($amount);
            
            // Create Reference Code
            $ref = $this->createReference('transfer');

            // Create Transaction from request data
            $request->merge(['amount' => $amount, 'type'=> 'deposit', 'role' => $role, 'balance' => $sender->balance(), 'reference' => $ref, 'recipient' => $recipient->id, 'status' => 'succeed']);
            // dd($request);
            $transfer = Transaction::create($request->all());
            
            // Save users transaction
            $sender->transactions()->save($transfer);
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', 'An error occured!');
        }

        DB::commit();

    }

    protected function createReference($type) {
        switch ($type) {
            case 'transfer':
                $reference = 'NRX'.time() .'TRF';
                break;
            case 'withdrawal':
                $reference = 'NRX'.time() .'WTH';
                break;
            case 'buy':
                $reference = 'NRX'.time() .'INV';
                break;
            case 'sell':
                $reference = 'NRX'.time() .'SEL';
                break;
            case 'deposit':
                $reference = 'NRX'.time() .'CDR';
                break;
            case 'referral':
                $reference = 'NRX'.time() .'REF';
                break;
            default:
                $reference = 'NRX-'.time() .'-PAY';
                break;
        }
        return $reference;
    }
}