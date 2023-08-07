<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    use HasFactory;

    protected $table = 'features';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'modul', 'name', 'desc', 'created_by'
    ];

    // Get Data Filter
    public function scopeFilter($query, $name, $modul)
    {
        return $query->join(
            'users',
            'created_by',
            '=',
            'users.id'
        )
        ->join(
            'modul',
            'modul',
            '=',
            'modul.id'
        )
        ->where(
            function ($query) use ($name, $modul) {
                if (null != $name) :
                    $query->where('features.name', 'LIKE', '%'. $name .'%');
                endif;

                if (null != $modul) :
                    $query->where('features.modul', 'LIKE', '%'. $modul .'%');
                endif;
            }
        );
    }

    // Get Data Detail
    public function scopeDetail($query)
    {
        return $query->join(
            'users',
            'created_by',
            '=',
            'users.id'
        )
        ->join(
            'modul',
            'modul',
            '=',
            'modul.id'
        );
    }

    // Search By ID
    public function scopeId($query, $id)
    {
        return $query->join(
            'users',
            'created_by',
            '=',
            'users.id'
        )
        ->where('features.id', $id);
    }

    // Get Data Simple
    public function scopeSimpleId($query, $id)
    {
        return $query->where('id', $id);
    }

    // Search By Name
    public function scopeName($query, $name)
    {
        return $query->where('name', $name);
    }

    // Check Duplicate Name
    public function scopeDuplicateName($query, $name, $id)
    {
        return $query->where('name', $name)->where('id', '<>', $id);
    }
}
