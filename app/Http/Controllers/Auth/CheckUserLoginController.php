<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use Illuminate\Http\Request;

class CheckUserLoginController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            new ResponseResource(200, 'Get Data User Login Success', $request->user_login),
            200
        );
    }
}
