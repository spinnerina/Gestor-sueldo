<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Jobs;
use App\Models\Debts;
use App\Models\Expenses;
use App\Models\RoleUser;
use App\Models\Companies;
use App\Models\ExpenseCategories;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'phone',
        'is_blocked',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* Relationships */
    public function debts()
    {
        return $this->hasMany(Debts::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }

    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }

    public function companies()
    {
        return $this->hasMany(Companies::class);
    }

    public function expensesCategories()
    {
        return $this->hasMany(ExpenseCategories::class);
    }

    public function roleUser()
    {
        return $this->hasMany(RoleUser::class);
    }
}
