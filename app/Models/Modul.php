<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $table = 'modul';
    protected $primarykey = 'id';

    protected $fillable = [
        'id', 'name', 'menu', 'desc', 'created_by',
    ];

    // Search By Id
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    // Search Bu Name
    public function scopeName($query, $name)
    {
        return $query->where('name', $name);
    }

    public function scopeCheckName($query, $name, $id)
    {
        return $query->where('name', $name)->where('id', '<>', $id);
    }

    // Get Data Modul -> User
    public function scopeToUser($query)
    {
        return $query->join(
            'users',
            'created_by',
            '=',
            'users.id'
        );
    }

    // Get Data Detail Modul -> User -> Menu
    public function scopeGetDetail($query)
    {
        return $query->join(
            'users',
            'created_by',
            '=',
            'users.id'
        )
        ->join(
            'menu',
            'menu',
            '=',
            'menu.id'
        );
    }

    // Get Data Filter
    public function scopeFilter($query, $name, $menu)
    {
        return $query->join(
            'users',
            'created_by',
            '=',
            'users.id'
        )
        ->join(
            'menu',
            'menu',
            '=',
            'menu.id'
        )
        ->where(function ($query) use ($name, $menu) {
            if (null != $name) :
                $query->where('modul.name', 'LIKE', '%'. $name .'%');
            endif;

            if (null != $menu) :
                $query->where('modul.menu', 'LIKE', '%'. $menu .'%');
            endif;
        });
    }
}
