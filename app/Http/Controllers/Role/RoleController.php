<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Traits\RoleTraits;

class RoleController extends Controller
{
    use RoleTraits;

    // List Role
    public function list(Request $request, $config)
    {
        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;

        // Handle Undefined Config
        if ('detail' != $config && 'simple' != $config) :
            return $this->invalidValidation();
        endif;

        // Logic Simple Config
        if ('simple' == $config) :
            $data = Roles::all($this->roleSimpleField());
            $countData =count($data);
        endif;

        // Logic Detail Config
        if ('detail' == $config) :
            $data = Roles::join(
                'users',
                'created_by',
                '=',
                'users.id'
            )
            ->paginate($items, $this->roleDetailField());

            // Count Data
            $countData = count($data);

            // Add Index Number
            $data = (null == $countData) ? false : $this->addIndexNumber($data);
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get List Role Failed');
        endif;

        // Response Success
        if (0 != $countData) :
            return $this->configResponse(200, 'Get List Role Success', $data, $config);
        endif;

        // Response Not Found
        if (0 == $countData) :
            return $this->roleNotFound();
        endif;
    }

    // Add Role
    public function add(Request $request)
    {
        // Inisialisasi Variable
        $name = $request->name;
        $desc = $request->desc;
        $userLogin = $request->user_login['id_user'];

        // Validasi Data Mandatory
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'desc' => ['required', 'string', 'max:100'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Cek Data Role By Name
        if (false != $this->cekRoleName($name)) :
            return $this->duplicateRoleName();
        endif;

        // Inisialisasi Create Field
        $addField = [
            'name' => $name,
            'desc' => $desc,
            'created_by' => $userLogin,
        ];

        // Logic Create Data
        $data = Roles::create($addField);

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Add Role Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Add Role Success');
        endif;
    }

    // Get Data Role
    public function show(Request $request)
    {
        // Inisialisasi Variable
        $id = $request->id;

        // Validasi Data Mandatori
        try {
            $request->validate(['id' => ['required', 'numeric']]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Get Data
        $data = Roles::id($id)->first($this->roleSimpleField());

        // Response Not Found
        if (null == $data) :
            return $this->roleNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get Data Role Failed');
        endif;

        // Response Success
        if (null != $data) :
            return $this->generalResponse(200, 'Get Data Role Success', $data);
        endif;
    }

    // Update Role
    public function update(Request $request, $id)
    {
        // Inisialisasi Variable
        $name = $request->name;
        $desc = $request->desc;
        $userLogin = $request->user_login['id_user'];

        // Validasi Data Mandatory
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'desc' => ['required', 'string', 'max:50'],
            ]);

            // Cek Duplicate Name
            $cekName = Roles::name($name)->where('id', '<>', $id)->first('name');
            if (null != $cekName) :
                return $this->duplicateRoleName();
            endif;
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Get Data
        $data = $this->cekRoleId($id);

        // Response Not Found
        if (false == $data) :
            return $this->roleNotFound();
        endif;

        // Logic Update data
        $data->name = $name;
        $data->desc = $desc;
        $data->created_by = $userLogin;
        $data->save();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Update Role Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Update Role Success');
        endif;
    }

    // Delete
    public function delete($id)
    {
        // Logic Get Data
        $data = $this->cekRoleId($id);

        // Response Not Found
        if (false == $data) :
            return $this->RoleNotFound();
        endif;

        // Logic Delete data
        $data->delete();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Delete Role Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Delete Role Success');
        endif;
    }

    // Filter
    public function filter(Request $request)
    {
        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;
        $name = $request->name;

        // Validasi Data Mandatori
        try {
            $request->validate([
                'name' => ['string', 'max:100'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Get Data
        $data = Roles::join(
            'users',
            'created_by',
            '=',
            'users.id'
        )
        ->where(
            function ($query) use ($name) {
                if (null != $name) :
                    $query->where('roles.name', 'LIKE', '%'. $name .'%');
                endif;
            }
        )
        ->paginate($items, $this->roleDetailField());

        // Add Index Number
        $data = $this->addIndexNumber($data);

        // Response Not Found
        if (null == count($data)) :
            return $this->roleNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Filter Data Role Failed');
        endif;

        // Response Sukses
        if (null != count($data)) :
            return $this->generalResponse(200, 'Filter Data Role Success', $data);
        endif;
    }
}
