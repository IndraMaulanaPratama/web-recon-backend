<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserController;
use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Traits\RoleTraits;
use App\Traits\UserTraits;
use App\Traits\UserRoleTraits;

class UserRoleController extends Controller
{
    use RoleTraits;
    use UserTraits;
    use UserRoleTraits;

    // *** Protected Function *** //
    protected function simpleField()
    {
        return [
            'users_roles.id AS ID',
            'roles.id AS ROLE_ID',
            'roles.name AS ROLE_NAME',
            'users.id AS USER_ID',
            'users.username AS USER_NAME'
        ];
    }
    // *** End Of Protected Function *** //


    // Get List
    public function list(Request $request)
    {
        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;

        // Logic Get Data
        $data = UsersRoles::getData()->paginate($items, self::simpleField());
        $countData = count($data);

        // Add Index Number
        $data = $this->addIndexNumber($data);

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get List Role User Failed');
        endif;

        // Response Success
        if (0 != $countData) :
            return $this->generalResponse(200, 'Get List Role User Success', $data);
        endif;

        // Response Not Found
        if (0 == $countData) :
            return self::userRoleNotFound();
        endif;
    }

    // Add User Role
    public function add(Request $request)
    {
        // Inisialisasi Variable
        $role = $request->role_id;
        $user = $request->user_id;

        // Validasi Data Mandatory
        try {
            $request->validate([
                'role_id' => ['required', 'numeric'],
                'user_id' => ['required', 'numeric'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Cek Data Role
        $cekRole = $this->cekRoleId($role);
        if (false == $cekRole) :
            return $this->roleNotFound();
        endif;

        // Cek Data User
        $cekUser = $this->cekUserById($user);
        if (false == $cekUser) :
            return $this->userNotFound();
        endif;

        // Cek Duplicated Data
        $cekDuplicated = $this->userRoleDuplicated($user, $role);
        if (false == $cekDuplicated) :
            return $this->userRoleExists();
        endif;

        // Inisialisasi Add Field
        $field = [
            'role' => $role,
            'user' => $user,
        ];

        // Logic Create Data
        $data = UsersRoles::create($field);

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Add Role-User Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Add Role-User Success');
        endif;
    }

    // Delete
    public function delete($id)
    {
        // Logic Get Data
        $data = $this->cekUserRoleById($id);

        // Response Not Found
        if (false == $data) :
            return $this->userRoleNotFound();
        endif;

        // Logic Delete Data
        $data->delete();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Delete Role-User Failed');
        endif;

        // Reponse Success
        if ($data) :
            return $this->generalResponse(200, 'Delete Role-User Success');
        endif;
    }

    // Filter
    public function filter(Request $request)
    {
        // Inisialisasi Variable
        $user = $request->user_name;
        $role = $request->role_name;
        $items = (null == $request->items) ? 10 : $request->items;

        // Logic Get Data
        $data = $this->userRoleFilter($items, $user, $role);

        // Response Not Found
        if (false == $data) :
            return $this->userRoleNotFound();
        endif;

        // Response Success
        if (false != $data) :
            // Add Index Number
            $data = $this->addIndexNumber($data);
            return $this->generalResponse(200, 'Filter Data Role User Success', $data);
        endif;
    }
}
