<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // *** RELATIONS TABLE ***
    public function userRole()
    {
        return $this->hasMany(UsersRoles::class, 'user', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'id');
    }
    // *** END OF RELATIONS TABLE ***

    // Cari User By ID
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    // Cari User By Email
    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    // Cari User By Username
    public function scopeUsername($query, $username)
    {
        return $query->where('username', $username);
    }
}
