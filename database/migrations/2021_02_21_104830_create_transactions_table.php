<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->enum('type', ['invest', 'referral', 'deposit', 'payout']);
            $table->string('reference');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('balance')->nullable();
            $table->enum('status', ['closed', 'pending', 'succeed'])->default('pending'); 
            $table->enum('role', ['funder', 'admin', 'user'])->default('user');
            $table->foreignId('recipient')
                    ->nullable()
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}