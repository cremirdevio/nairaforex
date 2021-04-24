<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('thumbnail')->nullable();
            $table->string('nationality');
            $table->decimal('returns', 5, 2);
            $table->integer('duration');
            $table->enum('duration_', ['days', 'weeks', 'months', 'years'])->default('weeks');
            $table->string('experience');
            $table->decimal('mbg', 4, 2);
            $table->decimal('rating', 3, 1)->default(10.0);
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
        Schema::dropIfExists('traders');
    }
}