<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'password_resets';
    protected $primaryKey = 'email';

    protected $fillable = [
        'email', 'token'
    ];

    // Validate Token
    public function scopeValidateToken($query, $email, $token)
    {
        return $query->where('token', $token)->where('email', $email);
    }

    // Search by email
    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }
}
