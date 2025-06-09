<?php

namespace App\Models;

use App\Models\Jobs;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salaries extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'payment_date',
        'gross_amount',
        'net_amount',
        'currency_id',
        'description',
        'payslip_url',
        'status',
    ];

    /* Relationships */

    public function job()
    {
        return $this->belongsTo(Jobs::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
