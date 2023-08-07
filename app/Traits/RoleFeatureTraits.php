<?php

namespace App\Traits;

use App\Models\RolesFeatures;
use App\Traits\ApiResponser;

trait RoleFeatureTraits
{
    use ApiResponser;

    // Config Response Field
    public function featureRoleField()
    {
        return [
            'roles_features.id AS ID',
            'roles.id AS ROLE_ID',
            'roles.name AS ROLE_NAME',
            'features.id AS FEATURE_ID',
            'features.name AS FEATURE_NAME',
        ];
    }

    // Response Not Found
    public function featureRoleNotFound()
    {
        return $this->generalResponse(404, 'Data Role-Feature Not Found');
    }

    // Get List Role Feature
    public function featureRoleList($items)
    {
        // Logic Get Data
        $data = RolesFeatures::roleFeature()->paginate($items, $this->featureRoleField());
        $countData = count($data);

        // Data Not Found
        if (null == $countData) :
            return false;
        endif;

        // Response Success
        if (null != $countData) :
            return $data;
        endif;
    }

    // Filter Role Feature
    public function featureRoleFilter($items, $role, $feature)
    {
        // Logic Get Data
        $data = RolesFeatures::filter($role, $feature)->paginate($items, $this->featureRoleField());
        $countData = count($data);

        // null == false | !null == $data
        return (null != $countData) ? $data : false;
    }

    // Search By ID
    public function featureRoleById($id)
    {
        $data = RolesFeatures::id($id)->first();

        // Data Not Found
        if (null == $data) :
            return false;
        endif;

        // Return Success
        if (null != $data) :
            return $data;
        endif;
    }

    // Cek Duplicated Data By User and Feature
    public function featureRoleDuplicateUserFeature($role, $feature)
    {
        $data = RolesFeatures::byRoleFeature($role, $feature)->first();

        // null == true | !null == $false
        return (null == $data) ? true : false;
    }
}
