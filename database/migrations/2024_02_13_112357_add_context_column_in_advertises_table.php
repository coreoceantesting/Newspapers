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
        Schema::table('advertises', function (Blueprint $table) {
            $table->string('context')->nullable()->after('work_order_number');
            $table->date('context_date')->nullable()->after('context');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertises', function (Blueprint $table) {
            $table->dropColumn('context');
            $table->dropColumn('context_date');
        });
    }
};
