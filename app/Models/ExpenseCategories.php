<?php

namespace App\Models;

use App\Models\User;
use App\Models\Expenses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by_user_id',
        'description',
        'status',
    ];

    /* Relationships */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }
}
