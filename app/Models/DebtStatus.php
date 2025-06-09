<?php

namespace App\Models;

use App\Models\Debts;
use Illuminate\Database\Eloquent\Model;

class DebtStatus extends Model
{   
    protected $table = 'debt_status';

    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = false;

    /* Relationships */
    public function debts()
    {
        return $this->hasMany(Debts::class);
    }
}
