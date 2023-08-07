<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'desc',
        'created_by',
    ];

    // *** Relation Area ***
    public function toRoleFeatures()
    {
        return $this->hasMany(RolesFeatures::class, 'role', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'CREATED');
    }

    // *** End Of Relation Area ***

    // Search By Id
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    // Search By Name
    public function scopeName($query, $name)
    {
        return $query->where('name', $name);
    }
}
