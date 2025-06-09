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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            /* User */
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->integer('interest_rate');
            $table->integer('number_of_installments');
            $table->unsignedBigInteger('debts_status_id');
            /* Debt Status */
            $table->foreign('debts_status_id')
                  ->references('id')
                  ->on('debt_status')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['debts_status_id']);
            $table->dropColumn('debts_status_id');
        });
        Schema::dropIfExists('debts');
    }
};
