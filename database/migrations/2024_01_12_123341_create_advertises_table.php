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
        Schema::create('advertises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publication_type_id')->nullable()->constrained();
            $table->foreignId('cost_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('print_type_id')->nullable()->constrained();
            $table->foreignId('banner_size_id')->nullable()->constrained();
            $table->string('unique_number')->nullable();
            $table->date('publication_date')->nullable()->constrained();
            $table->string('work_order_number')->nullable();
            $table->string('image')->nullable();
            $table->string('generate_pdf_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertises');
    }
};
