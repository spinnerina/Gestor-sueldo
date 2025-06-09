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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('debt_id');
            $table->foreign('debt_id')
                  ->references('id')
                  ->on('debts')
                  ->onDelete('cascade');
            $table->date('due_date');
            $table->decimal('amount', 10, 2);
            $table->boolean('status')->default(true);
            $table->date('payment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('installments', function (Blueprint $table) {
            $table->dropForeign(['debt_id']);
            $table->dropColumn('debt_id');
        });
        Schema::dropIfExists('installments');
    }
};
