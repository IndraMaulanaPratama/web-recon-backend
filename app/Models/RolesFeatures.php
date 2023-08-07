<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesFeatures extends Model
{
    use HasFactory;

    // protected $table = 'roles_features';
    // protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'feature', 'role'
    ];

    public function toFeatures()
    {
        return $this->belongsTo(Features::class, 'feature', 'id');
    }

    // Get Data Role Feature
    public function scopeRoleFeature($query)
    {
        $query->join(
            'features',
            'feature',
            '=',
            'features.id'
        )
        ->join(
            'roles',
            'role',
            '=',
            'roles.id'
        );
    }

    // Filter Role Feature
    public function scopeFilter($query, $role, $feature)
    {
        $query->join(
            'features',
            'feature',
            '=',
            'features.id'
        )
        ->join(
            'roles',
            'role',
            '=',
            'roles.id'
        )
        ->where(
            function ($query) use ($role, $feature) {
                if (null != $role) :
                    $query->where('roles.name', 'LIKE', '%'. $role .'%');
                endif;

                if (null != $feature) :
                    $query->where('features.name', 'LIKE', '%'. $feature .'%');
                endif;
            }
        );
    }

    // Search By Id
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    // Search By Role And Feature
    public function scopeByRoleFeature($query, $role, $feature)
    {
        return $query->where('role', $role)->where('feature', $feature);
    }
}
