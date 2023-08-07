<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'desc',
        'created_by',
    ];

    // Search Menu By Id
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    // Search Menu By Name
    public function scopeName($query, $name)
    {
        return $query->where('name', $name);
    }

    // Cek Duplicate Name
    public function scopeCekName($query, $name, $id)
    {
        return $query->where('name', $name)->where('id', '<>', $id);
    }

    // Join To Table User
    public function scopeToUser($query)
    {
        return $query->join(
            'users',
            'created_by',
            '=',
            'users.id'
        );
    }

    // Filter Data
    public function scopeFilter($query, $name)
    {
        return $query->join(
            'users',
            'created_by',
            '=',
            'users.id'
        )
        ->where(
            function ($query) use ($name) {
                if (null != $name) :
                    $query->where('menu.name', 'LIKE', '%'. $name .'%');
                endif;
            }
        );
    }
}
