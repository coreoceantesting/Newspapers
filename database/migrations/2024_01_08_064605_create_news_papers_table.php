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
        Schema::create('news_papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_paper_type_id')->constrained();
            $table->string('name');
            $table->string('editor_name');
            $table->string('email')->comment(', is separed for multiple email');
            $table->string('mobile')->comment(', is separed for multiple mobile number');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_papers');
    }
};
