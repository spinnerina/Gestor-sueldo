<?php

namespace App\Models;

use App\Models\Salaries;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    protected $fillable = [
        'name',
        'symbol',
        'is_active',
    ];

    public $timestamps = false;

    /* Relationships */
    public function salaries()
    {
        return $this->hasMany(Salaries::class);
    }
}
