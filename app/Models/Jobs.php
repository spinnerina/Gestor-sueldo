<?php

namespace App\Models;

use App\Models\User;
use App\Models\Salaries;
use App\Models\Companies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'job_title',
        'start_date',
        'end_date',
        'is_active',
    ];

    /* Relationships */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Companies::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salaries::class);
    }
}
