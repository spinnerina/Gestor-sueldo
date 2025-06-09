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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            /* Job */
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')
                  ->references('id')
                  ->on('jobs')
                  ->onDelete('cascade');
            $table->date('payment_date');
            $table->decimal('gross_amount', 10, 2);
            $table->decimal('net_amount', 10, 2);
            /* Currency */
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')
                  ->references('id')
                  ->on('currencies')
                  ->onDelete('cascade');
            $table->string('description')->nullable();
            $table->string('payslip_url')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->dropColumn('job_id');
            $table->dropForeign(['currency_id']);
            $table->dropColumn('currency_id');
        });
        Schema::dropIfExists('salaries');
    }
};
