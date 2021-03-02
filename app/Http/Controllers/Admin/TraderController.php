<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trader;
use App\Services\TraderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TraderController extends Controller
{
    protected $paginate_count = 15;

    protected $traderService;

    public function __construct(TraderService $traderService) {
        $this->traderService = $traderService;
    }

    public function index()
    {
        $traders = Trader::with('investors')->simplePaginate($this->paginate_count);
        return view('admin.traders', compact('traders'));
    }

    public function edit(Trader $trader)
    {
        return view('admin.edit-trader', compact('trader'));
    }

    public function update(Request $request, Stock $stock) {
        $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:3',
            'returns' => 'required|numeric',
            'duration' => 'required|numeric|min:0',
            'duration_' => 'required|in:days,weeks,months,years',
            'experience' => 'required|string',
            'mbg' => 'required|numeric|min:0|max:100',
            'rating' => 'required|numeric|min:0|max:10'
        ]);

        $stock->update($request->all());

        return back()->with('success', 'Trader\'s profile updated successfully!');
    }

    public function create() {
        // $c = config('countries');

        // $a = array();

        // foreach ($c as $g) {
        //     $str = "'".$g['Code']."' => '".$g['Name']."',";
        //     file_put_contents('filename.txt', print_r($str, true). "\n", FILE_APPEND);
        // }

        // return $a;
        return view('admin.create-trader');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:3',
            'returns' => 'required|numeric',
            'duration' => 'required|numeric|min:0',
            'duration_' => 'required|in:days,weeks,months,years',
            'experience' => 'required|string',
            'mbg' => 'required|numeric|min:0|max:100',
            'rating' => 'required|numeric|min:0|max:10'
        ]);

        // Call the service for creating the Trader
        try {
            $trader = $this->traderService->createTrader($request);
        } catch (\Throwable $e) {
            return back()->with('error', 'Error occured while creating a new resource.');
        }

        return redirect()->route('admin.traders.edit', [$trader])->with('info', 'Trader created successfully!');
    }

    public function upload(Request $request, Trader $trader) {
        $request->validate([
            'thumbnail' => 'required|file|image|mimes:jpeg,png|max:2048'
        ]);

        $this->traderService->uploadImage($request, $trader);

        return back()->with('success', 'Traders thumbnail uploaded successfully!');
    }

    public function destroy(Trader $trader) {
        return $this->traderService->deleteTrader($trader);
    }

    // public function post(Stock $stock) {
    //     return view('admin.admin-post-update', compact('stock'));
    // }

    // public function postUpdate(Request $request, Stock $stock) {
    //     $request->validate([
    //         'post' => 'required|string'
    //     ]);

    //     $stock->update([
    //         'message_title' => $request->post_title,
    //         'message_body' => $request->post,
    //         'post_date' => now(),
    //     ]);

    //     return back()->with('success', 'Notification updated successfully!');
    // }

    // public function postClear(Stock $stock) {
    //     $stock->update([
    //         'message_title' => null,
    //         'message_body' => null,
    //         'post_date' => null,
    //     ]);

    //     return back()->with('success', 'Notification cleared successfully!');
    // }

}