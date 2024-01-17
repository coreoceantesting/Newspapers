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
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('advertise_id')->constrained();
            $table->foreignId('news_paper_id')->constrained();
            $table->string('bill_number');
            $table->string('bank');
            $table->string('branch');
            $table->string('account_number');
            $table->string('ifsc_code');
            $table->string('pan_card');
            $table->date('bill_date');
            $table->string('basic_amount');
            $table->string('gst');
            $table->string('gross_amount');
            $table->string('tds');
            $table->string('it');
            $table->string('net_amount');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing');
    }
};
