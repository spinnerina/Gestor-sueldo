<?php

namespace App\Models;

use App\Models\Debts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Installments extends Model
{
    use HasFactory;

    protected $fillable = [
        'debt_id',
        'due_date',
        'amount',
        'status',
        'payment_date',
    ];

    /* Relationships */
    public function debt()
    {
        return $this->belongsTo(Debts::class);
    }
}
