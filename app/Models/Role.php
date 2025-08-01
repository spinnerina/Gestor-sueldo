<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'is_active'];

    public $timestamps = false;

    /* Relationships */

    public function roleUser()
    {
        return $this->hasMany(RoleUser::class);
    }
}
