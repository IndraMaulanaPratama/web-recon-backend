<?php

namespace App\Traits;

use App\Models\UsersRoles;

trait UserRoleTraits
{
    // Response Simple
    protected function userRoleSimpleField()
    {
        return [
            'users_roles.id AS ID',
            'roles.id AS ROLE_ID',
            'roles.name AS ROLE_NAME',
            'users.id AS USER_ID',
            'users.username AS USER_NAME'
        ];
    }

    // Response Not Found
    public function userRoleNotFound()
    {
        return $this->generalResponse(404, 'Data Role-User Not Found');
    }

    // Response Dupicated User Role
    public function userRoleExists()
    {
        return $this->generalResponse(409, 'Data Role-User Exists');
    }

    // Search By ID
    public function cekUserRoleById($id)
    {
        $data = UsersRoles::id($id)->first();
        if (null == $data) :
            return false;
        endif;

        if (null != $data) :
            return $data;
        endif;
    }

    // Cek Duplicated User Role
    public function userRoleDuplicated($user, $role)
    {
        $data = UsersRoles::byUserRole($user, $role)->first();

        // null == true | !null == false
        return (null == $data) ? true : false;
    }

    // Get Data Filter
    public function userRoleFilter($items, $user, $role)
    {
        $data = UsersRoles::getData()
        ->where(
            function ($query) use ($user, $role) {
                if (null != $user) :
                    $query->where('users.name', 'LIKE', '%'. $user . '%');
                endif;

                if (null != $role) :
                    $query->where('roles.name', 'LIKE', '%'. $role . '%');
                endif;
            }
        )
        ->paginate($items, $this->userRoleSimpleField());
        $countData = count($data);

        // null == false | !null == $data
        return (null != $countData) ? $data : false;
    }
}
