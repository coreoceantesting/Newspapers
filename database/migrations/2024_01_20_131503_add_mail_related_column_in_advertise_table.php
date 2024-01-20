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
            $table->boolean('is_mail_send')->default(0);
            $table->string('email_subject')->nullable();
            $table->text('email_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertise', function (Blueprint $table) {
            $table->dropColumn('is_mail_send');
            $table->dropColumn('email_subject');
            $table->dropColumn('email_description');
        });
    }
};
