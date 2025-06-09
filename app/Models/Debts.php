<?php

namespace App\Models;

use App\Models\User;
use App\Models\DebtStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Debts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'total_amount',
        'interest_rate',
        'number_of_installments',
        'debts_status_id',
    ];

    /* Relationships */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function debtStatus()
    {
        return $this->belongsTo(DebtStatus::class);
    }

    public function installments()
    {
        return $this->hasMany(Installments::class);
    }
}
