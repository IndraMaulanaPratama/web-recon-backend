<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getListAccount(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'account/list/'.$config, $dataBody);
    }

    public function addNewAccount(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'account/add', $dataBody);
    }

    public function getDataAccount(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'account/get-data', $dataBody);
    }

    public function updateAccount(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'account/update/'.$id, $dataBody);
    }

    public function deleteAccount(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'account/delete/'.$id, $dataBody);
    }

    public function filterAccount(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'account/filter/', $dataBody);
    }

    public function deleteData(Request $request, $id)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('DELETE', 'account/delete/'.$id, $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'account/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'account/restore', $dataBody);
    }
}
