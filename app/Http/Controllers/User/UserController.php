<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Traits\UserTraits;

class UserController extends Controller
{
    use ApiResponser;
    use UserTraits;

    // Get List User
    public function list(Request $request, $config)
    {
        // Inisialisasi Variable
        $items = (null == $request->items) ? null : $request->items;

        // Handle Unfefined Config
        if ('detail' != $config && 'simple' != $config) :
            return $this->invalidValidation();
        endif;

        // Logic Simple Config
        if ('simple' == $config) :
            $data = User::all($this->userSimpleField());
        endif;

        // Logic Detail Config
        if ('detail' == $config) :
            $data = User::paginate($items, $this->userDetailField());
            $data = $this->addIndexNumber($data);
        endif;

        // Response Not Found
        if (null == $data || null == count($data)) :
            return $this->userNotFound();
        endif;

        // Response Sukses
        if (null != $data) :
            return $this->configResponse(200, 'Get List User Success', $data, $config);
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get List User Failed');
        endif;
    }

    // Add User / Register
    public function add(Request $request)
    {
        // Inisialisasi Variable
        $username = $request->username;
        $email = $request->email;
        $name = $request->name;
        $password = bcrypt($request->password);

        // Invalid Data Mandatori V1
        try {
            $request->validate(
                [
                    'username' => ['required', 'string', 'max:50'],
                    'email' => ['required', 'email:rfc,dns', 'max:100'],
                    'name' => ['required', 'string', 'max:100'],
                    'password' => ['required', 'string', 'max:60'],
                ]
            );

            // Cek Duplicate Username
            $cekUsername = $this->cekUserByUsername($username);
            if (false == $cekUsername) :
                return $this->duplicateUsername();
            endif;

            // Cek Duplicate Email
            $cekEmail = $this->cekUserByEmail($email);
            if (false == $cekEmail) :
                return $this->duplicateEmail();
            endif;
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Invalid Data Mandatori V2
        // try {
        //     $request->validate(
        //         [
        //             'username' => ['required', 'string', 'max:50', 'unique:users,username'],
        //             'email' => ['required', 'email:rfc,dns', 'max:100', 'unique:users,email'],
        //             'name' => ['required', 'string', 'max:100'],
        //             'password' => ['required', 'string', 'max:60'],
        //         ],
        //         [
        //             'unique' => ':attribute Duplicate'
        //         ]
        //     );

        // } catch (ValidationException $th) {
        //     return $this->invalidValidation($th->validator->errors());
        // }

        // Inisialisasi Field/Column
        $column = [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ];

        // Logic Add Data
        $data = User::create($column);

        // Response Sukses
        if ($data) :
            return $this->generalResponse(200, 'Registration User Success');
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Registration User Failed');
        endif;
    }

    // Get Data
    public function show(Request $request)
    {
        // Inisialisasi Variable
        $id = $request->id;

        // Validasi Data Mandatory
        try {
            $request->validate(['id' => ['required', 'numeric']]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Get Data
        $data = $this->userGetData($id);

        // Response Not Found
        if (false == $data) :
            return $this->userNotFound();
        endif;

        // Response Success
        if (false != $data) :
            return $this->generalResponse(200, 'Get Data User Success', $data);
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get Data User Failed');
        endif;
    }

    // Update User
    public function update(Request $request, $id)
    {
        // Cek User
        $data = $this->cekUserById($id);
        if (false == $data) :
            return $this->userNotFound();
        endif;

        // Inisialisasi Variable
        $username = $request->username;
        $email = $request->email;
        $name = $request->name;
        $password = (null == $request->password) ? null : bcrypt($request->password);

        // Invalid Data Mandatori V1
        try {
            $request->validate([
                'username' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email:rfc,dns', 'max:100'],
                'name' => ['required', 'string', 'max:100'],
                'password' => ['string', 'max:60'],
            ]);

            // Cek Duplicate Username
            $cekUsername = User::username($username)->where('id', '<>', $id)->first('username');
            if (null != $cekUsername) :
                return $this->duplicateUsername();
            endif;

            // Cek Duplicate Email
            $cekEmail = User::email($email)->where('id', '<>', $id)->first('email');
            if (null != $cekEmail) :
                return $this->duplicateEmail();
            endif;
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Update User
        $data->username = $username;
        $data->name = $name;
        $data->email = $email;
        (null != $password) ? $data->password = $password : null;
        $data->save();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Update User Failed');
        endif;

        // Response Sukses
        if ($data) :
            return $this->generalResponse(200, 'Update User Success');
        endif;
    }

    // Delete User
    public function delete(Request $request, $id)
    {
        // Inisialisasi Variable
        $id = $request->id;

        // Cek Data User
        $data = $this->cekUserById($id);
        if (false == $data) :
            return $this->userNotFound();
        endif;

        // Validasi Data Mandatori
        try {
            $request->validate([
                'id' => ['request', 'numeric', 'digits_between:1,11'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Delete
        $data->delete();

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Delete User Success');
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Delete User Failed');
        endif;
    }

    // Filter User
    public function filter(Request $request)
    {
        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;
        $name = $request->name;
        $username = $request->username;
        $email = $request->email;

        // Validasi Data Mandatori
        try {
            $request->validate([
                'name' => ['string', 'max:100'],
                'username' => ['string', 'max:50'],
                'email' => ['string', 'max:100'],
                'items' => ['numeric', 'digits_between:1,8'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Get Data
        $data = User::where(
            function ($query) use ($name, $username, $email) {
                // Filter By username
                if (null != $username) :
                    $query->where('username', 'LIKE', '%'. $username .'%');
                endif;

                // Filter By email
                if (null != $email) :
                    $query->where('email', 'LIKE', '%'. $email .'%');
                endif;

                // Filter By name
                if (null != $name) :
                    $query->where('name', 'LIKE', '%'. $name .'%');
                endif;
            }
        )
        ->paginate($items, $this->userDetailField());

        // Add Index Number
        $data = $this->addIndexNumber($data);

        // Response Sukses
        if (null != count($data)) :
            return $this->generalResponse(200, 'Filter Data User Success', $data);
        endif;

        // Response Not Found
        if (null == count($data)) :
            return $this->userNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Filter Data User Failed');
        endif;
    }
}
