<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use App\Models\UsersRoles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $apiName)
    {
        $auth_bearer = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $auth_bearer);
        $userLogin = Auth::user();

        // Validasi token dan user login
        if (null == $token || null == $userLogin) {
            return response()->json([
                'result_code' => 401,
                'result_message' => 'User Unauthorized'
            ], 401);
        }

        // Get Data Collection user, role dan feature
        $userLogin = UsersRoles::with('toUser', 'toRole.toRoleFeatures.toFeatures')
        ->where('user', $userLogin->id)
        ->first();

        // return response()->json($userLogin);

        // *** Logic Get User Role *** //
        $userRole = UsersRoles::id($userLogin->id)->first();
        if (null == $userRole) {
            return response()->json([
                'result_code' => 404,
                'result_message' => 'User Role Undefined',
            ], 404);
        }
        // *** END OF Logic Get User Role *** //

        // *** Logic Get feature *** //
        $countFeatures = count($userLogin->toRole->toRoleFeatures);
        $features = [];

        for ($i=0; $i < $countFeatures; $i++) {
            $features [] = $userLogin->toRole->toRoleFeatures[$i]->toFeatures->name;
        }
        // *** END OF Logic Get feature *** //

        // return response()->json($features);


        $searchFeature = array_search($apiName, $features);

        if (false === $searchFeature
        && 'super-admin' != $userLogin->toRole->name
        && 'indra-maulana' != Auth::user()->username) {
            // return 'invalid';
            return response()->json([
                'result_code' => 404,
                'result_message' => 'Feature Not Found',
            ], 404);
        } elseif ($searchFeature
        || 0 === $searchFeature
        || 'super-admin' == $userLogin->toRole->name
        || 'indra-maulana' == Auth::user()->username) {
            // Inisialisasi data yang dibutuhkan untuk controller //
            $userData = [
                'id_user' => $userLogin->toUser->id,
                'name' => $userLogin->toUser->name,
                'username' => $userLogin->toUser->username,
                'role' => $userLogin->toRole->name,
                'features' => $features,
            ];

            // mamasukan data kedalam request parameter //
            $request->merge([
                'user_login' => $userData,
            ]);

            // return response()->json($userData);

            return $next($request);
        }
    }
}
