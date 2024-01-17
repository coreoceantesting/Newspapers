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
        Schema::table('advertise_costs', function (Blueprint $table) {
            $table->dropColumn('work_cost');
            $table->foreignId('cost_id')->after('no_of_newspaper')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertise_cost', function (Blueprint $table) {
            //
        });
    }
};
