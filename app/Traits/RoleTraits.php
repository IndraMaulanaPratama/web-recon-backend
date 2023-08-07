<?php

namespace App\Traits;

use App\Models\Roles;

trait RoleTraits
{
    protected function roleSimpleField()
    {
        return [
            'id AS ID',
            'name AS NAME',
            'desc AS DESC'
        ];
    }

    protected function roleDetailField()
    {
        return [
            'roles.id AS ID',
            'roles.name AS NAME',
            'desc AS DESC',
            'users.name AS CREATED',
            'roles.created_at AS CREATED_AT',
        ];
    }

    public function roleNotFound()
    {
        return $this->generalResponse(404, 'Data Role Not Found');
    }

    public function duplicateRoleName()
    {
        return $this->generalResponse(409, 'Name Duplicated');
    }

    public function cekRoleId($id)
    {
        $data = Roles::id($id)->first();
        if (null == $data) :
            return false;
        endif;

        if (null != $data) :
            return $data;
        endif;
    }

    public function cekRoleName($name)
    {
        $data = Roles::name($name)->first('name');
        if (null == $data) :
            return false;
        endif;

        if (null != $data) :
            return $data;
        endif;
    }
}
