<?php

namespace App\Http\Controllers\GroupBiller;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupBillerController extends Controller
{
    public function getListGb(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'group-biller/list/'.$config, $dataBody);
    }

    public function addNewGb(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'group-biller/add', $dataBody);
    }

    public function getDataGb(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'group-biller/get-data', $dataBody);
    }

    public function updateGb(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'group-biller/update/'.$id, $dataBody);
    }

    public function deleteGb(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'group-biller/delete/'.$id, $dataBody);
    }

    public function getBillerGb(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'group-biller/list-biller', $dataBody);
    }

    public function listAddGb(Request $request, $config)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'group-biller/list-add-biller/'. $config, $dataBody);
    }

    public function addBillerGb(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'group-biller/add-biller', $dataBody);
    }

    public function deleteBillerGb(Request $request, $id)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('DELETE', 'group-biller/delete-biller/'. $id, $dataBody);
    }

    public function deleteData(Request $request, $id)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('DELETE', 'group-biller/delete-data/'. $id, $dataBody);
    }

    public function filterGb(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'group-biller/filter/', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'group-biller/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'group-biller/restore', $dataBody);
    }
}
