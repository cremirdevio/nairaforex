<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', App\Http\Controllers\WelcomePageServer::class);

// Traders Route ✔
Route::get('/remote-traders', [App\Http\Controllers\TraderController::class, 'index'])->name('traders');
       
Route::group(['middleware' => 'auth', 'web'], function () {
    Route::group(['middleware' => 'profile.update'], function () {
        // Transaction Routes ✔
        Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions');
        Route::delete('/transactions', [App\Http\Controllers\TransactionController::class, 'destroy'])->name('transactions.delete');
        // Route::get('/deposit-funds', [App\Http\Controllers\User\TransactionController::class, 'deposit'])->name('deposit');

        // Withdrawals Route ✔
        Route::get('/withdrawal-history', [App\Http\Controllers\WithdrawalController::class, 'index'])->name('withdrawals');
        Route::get('/withdraw-funds', [App\Http\Controllers\WithdrawalController::class, 'create'])->name('withdrawals.create');
        Route::post('/withdraw-funds', [App\Http\Controllers\WithdrawalController::class, 'store'])->name('withdrawals.store');
        Route::delete('/withdrawal/cancel', [App\Http\Controllers\WithdrawalController::class, 'destroy'])->name('withdrawals.delete');

        // Authenticated ✔
        Route::post('/traders-list/{trader}', [App\Http\Controllers\TraderController::class, 'store'])->name('traders.assign');
        Route::get('/portfolio', [App\Http\Controllers\HomeController::class, 'portfolio'])->name('portfolio');
        Route::post('/portfolio/{trade}', [App\Http\Controllers\HomeController::class, 'activatePayment'])->name('activate.payment');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'portfolio'])->name('home');
 
    });

    // Account ✔
    Route::get('/account-settings', [App\Http\Controllers\HomeController::class, 'index'])->name('account');
    Route::put('/account-settings/banking', [App\Http\Controllers\HomeController::class, 'wallet_update'])->name('account.wallet.update');

    // Admin Routes
    Route::group(['middleware' => ['role:admin|compiler|funder|customer service']], function() {
        // Main Admin Dashboard ✔
        Route::get('/admin/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');

        // Users Route ✔
        Route::group(['middleware' => ['role:admin|customer service']], function() {
            Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
            Route::get('/admin/users/search', [App\Http\Controllers\Admin\UserController::class, 'search'])->name('admin.users.search');
        });

        
        Route::group(['middleware' => ['role:admin|compiler']], function() {
            // Traders Route ✔
            Route::get('/admin/traders', [App\Http\Controllers\Admin\TraderController::class, 'index'])->name('admin.traders');
            Route::get('/admin/traders/create', [App\Http\Controllers\Admin\TraderController::class, 'create'])->name('admin.traders.create');
            Route::post('/admin/traders/create', [App\Http\Controllers\Admin\TraderController::class, 'store'])->name('admin.traders.store');
            Route::get('/admin/traders/edit/{trader:name}', [App\Http\Controllers\Admin\TraderController::class, 'edit'])->name('admin.traders.edit');
            Route::put('/admin/traders/{trader}', [App\Http\Controllers\Admin\TraderController::class, 'upload'])->name('admin.traders.update');
            Route::delete('/admin/traders/{trader}', [App\Http\Controllers\Admin\TraderController::class, 'destroy'])->name('admin.traders.delete');
            // Upload Trader Icon
            Route::post('/admin/traders/{trader}/icon', [App\Http\Controllers\Admin\TraderController::class, 'upload'])->name('admin.traders.icon');

            // Testimonials Route ✔
            Route::get('/admin/testimonials', [App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('admin.testimonials');
            Route::get('/admin/testimonials/create', [App\Http\Controllers\Admin\TestimonialController::class, 'create'])->name('admin.testimonials.create');
            Route::post('/admin/testimonials/create', [App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('admin.testimonials.store');
            Route::get('/admin/testimonials/edit/{testimonial}', [App\Http\Controllers\Admin\TestimonialController::class, 'edit'])->name('admin.testimonials.edit');
            Route::put('/admin/testimonials/{testimonial}', [App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('admin.testimonials.update');
            Route::delete('/admin/testimonials/{testimonial}', [App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('admin.testimonials.delete');

        });

        Route::group(['middleware' => ['role:admin|funder']], function() {
            // Withdrawal Route ✔
            Route::get('/admin/withdrawals', [App\Http\Controllers\Admin\WithdrawalController::class, 'index'])->name('admin.withdrawals');
            Route::post('/admin/withdrawals/{withdrawal:reference}', [App\Http\Controllers\Admin\WithdrawalController::class, 'settle'])->name('admin.withdrawals.settle');
            Route::delete('/admin/withdrawals/{withdrawal:reference}', [App\Http\Controllers\Admin\WithdrawalController::class, 'close'])->name('admin.withdrawals.close');

            // Funder Transfer Route ✔
            Route::get('/admin/transfer/funder', [App\Http\Controllers\Admin\TransactionController::class, 'funderTransferForm'])->name('admin.transfer.funder');
            Route::post('/admin/transfer', [App\Http\Controllers\Admin\TransactionController::class, 'transfer'])->name('admin.transfer');

        });

        
        Route::group(['middleware' => ['role:admin']], function() {
            // Users Roles Route ✔
            Route::get('/admin/roles', [App\Http\Controllers\Admin\UserController::class, 'roles'])->name('admin.roles');
            Route::get('/admin/roles/search', [App\Http\Controllers\Admin\UserController::class, 'role_user_search'])->name('admin.roles.search');
            Route::post('/admin/roles/attach', [App\Http\Controllers\Admin\UserController::class, 'attachRole'])->name('admin.roles.attach');
            Route::post('/admin/roles/detach', [App\Http\Controllers\Admin\UserController::class, 'detachRole'])->name('admin.roles.detach');

            // Withdrawal Route ✔
            Route::get('/admin/transactions', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.transactions');
            
            // Admin Transfer Route ✔
            Route::get('/admin/transfer', [App\Http\Controllers\Admin\TransactionController::class, 'adminTransferForm'])->name('admin.transfer');

        });
    });
});

// Route for static files
Route::get('/{slug}', [App\Http\Controllers\StaticController::class, 'show'])->name('static');