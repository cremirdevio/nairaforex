<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use App\Models\Stock;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected $transactionService;

    protected $paginate = 15;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $stocks = Stock::hasEvent()->simplePaginate($this->paginate);
        return view('stocks', compact('stocks'));
    }

    public function show(Stock $stock)
    {
        $currentEvent = $stock->current();
        $dataset = $stock->getChartData();

        $label = $dataset['label'];
        $data = $dataset['data'];

        //        return $stock->current();
        return view('single_stock', compact('stock', 'currentEvent', 'label', 'data'));
    }

    public function buyShares(Request $request, Stock $stock)
    {
        // Check if the users balance is sufficient
        $request->validate([
             'unit' => ['required', 'numeric', 'min:0.1', 'regex:/^\d+(\.\d{1,2})?$/']
        ]);

        // Price
        $amount = round($request->unit * $stock->get_current_price());

        if (!auth()->user()->isSufficient($amount)) {
            return back()->with('warning', 'You current wallet balance is insufficient for this transaction.');
        }

        $response = $this->transactionService->buyShares($request, $stock, $amount);

        return $response;
    }

    public function sellShares(Request $request)
    {
        $request->validate([
            'unit' => ['required', 'numeric', 'min:0.01', 'regex:/^\d+(\.\d{1,2})?$/'],
            'stock' => ['required', 'numeric',]
        ]);

        $stock = Stock::find($request->stock);

        $unit = auth()->user()->portfolio->find($stock)->pivot->unit;

        if ($unit < $request->unit) {
            return back()->with('warning', 'You can only sell within the limits of you unit balance.');
        }

        $response = $this->transactionService->sellShares($request, $stock);

        return $response;
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
