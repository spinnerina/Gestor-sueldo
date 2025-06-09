<?php

namespace App\Models;

use App\Models\Jobs;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Companies extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cuit',
        'description',
        'created_by_user_id',
        'status',
    ];

    /* Relationships */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }
}
