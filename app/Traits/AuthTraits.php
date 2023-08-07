<?php

namespace App\Traits;

use App\Models\PasswordReset;
use App\Traits\ApiResponser;

trait AuthTraits
{
    use ApiResponser;

    // Response Invalid Token Reset Password
    public function authInvalidToken()
    {
        return $this->responseNotFound('Invalid Token Reset Password');
    }

    // Validate Token Reset Password
    public function authValidateToken($email, $token)
    {
        $data = PasswordReset::validateToken($email, $token)->first();

        // null == False | !null == $data
        return (null != $data) ? $data : false;
    }

    // Search All Data By Email
    public function authEmailAll($email)
    {
        $data = PasswordReset::email($email)->first();

        // null == $data | !null == false
        return (null != $data) ? $data : false;
    }
}
