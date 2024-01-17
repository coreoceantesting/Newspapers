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
        Schema::table('billing', function (Blueprint $table) {
            $table->dropColumn('bank');
            $table->dropColumn('branch');
            $table->dropColumn('account_number');
            $table->dropColumn('ifsc_code');
            $table->dropColumn('pan_card');
            $table->foreignId('account_detail_id')->nullable()->after('news_paper_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('billing', function (Blueprint $table) {
            $table->string('bank')->after('bill_number');
            $table->string('branch')->after('bill_number');
            $table->string('account_number')->after('bill_number');
            $table->string('ifsc_code')->after('bill_number');
            $table->string('pan_card')->after('bill_number');
        });
    }
};
