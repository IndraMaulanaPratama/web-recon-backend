<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersRoles extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'users_roles';
    protected $primarykey = 'id';

    protected $fillable = [
        'id', 'role', 'user'
    ];

    // *** Relations Area *** ///
    public function toUser()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function toRole()
    {
        return $this->belongsTo(Roles::class, 'role', 'id');
    }
    // *** End Of Relations Area *** ///

    public function scopeSearchUser($query, $user)
    {
        return $query->where('user', $user);
    }

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeGetData($query)
    {
        return $query->join(
            'roles',
            'role',
            '=',
            'roles.id'
        )
        ->join(
            'users',
            'user',
            '=',
            'users.id'
        );
    }

    public function scopeByUserRole($query, $user, $role)
    {
        return $query->where('user', $user)->where('role', $role);
    }
}
