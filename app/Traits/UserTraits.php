<?php

namespace App\Traits;

use App\Models\User;

trait UserTraits
{
    protected function userSimpleField()
    {
        return [
            'id AS ID',
            'name AS NAME',
            'username AS USERNAME',
            'email AS EMAIL',
        ];
    }

    protected function userDetailField()
    {
        return [
            'id AS ID',
            'name AS NAME',
            'username AS USERNAME',
            'email AS EMAIL',
            'password AS PASSWORD',
            'created_at AS CREATED_AT',
            'updated_at AS UPDATED_AT',
        ];
    }


    public function userNotFound()
    {
        return $this->generalResponse(404, 'Data User Not Found');
    }

    public function duplicateUsername()
    {
        return $this->generalResponse(409, 'Username Duplicated');
    }

    public function duplicateEmail()
    {
        return $this->generalResponse(409, 'Email Duplicated');
    }

    public function userByEmail($email)
    {
        $data = User::email($email)->first();

        // null == false | !null == $data
        return (null != $data) ? $data : false;
    }

    public function cekUserById($id)
    {
        $data = User::id($id)->first();
        if (null == $data) :
            return false;
        endif;

        if (null != $data) :
            return $data;
        endif;
    }

    public function userGetData($id)
    {
        $data = User::id($id)->first($this->userSimpleField());
        if (null == $data) :
            return false;
        endif;

        if (null != $data) :
            return $data;
        endif;
    }


    protected function cekUserByUsername($username)
    {
        $data = User::username($username)->first('username');
        if (null != $data) :
            return false;
        endif;

        if (null == $data) :
            return true;
        endif;
    }

    protected function cekUserByEmail($email)
    {
        $data = User::email($email)->first('email');
        if (null != $data) :
            return false;
        endif;

        if (null == $data) :
            return true;
        endif;
    }
}
