<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expandetures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_id');
            $table->foreign('billing_id')->references('id')->on('billing');
            $table->foreignId('news_paper_id')->nullable()->constrained();
            $table->string('unique_no')->nullable();
            $table->string('invoice_amount')->nullable();
            $table->string('other_charges')->nullable();
            $table->string('net_amount')->nullable();
            $table->string('progressive_expandetures')->nullable();
            $table->string('balance')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expandetures');
    }
};
