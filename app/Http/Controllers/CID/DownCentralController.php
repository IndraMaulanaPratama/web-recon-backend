<?php

namespace App\Http\Controllers\CID;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DownCentralController extends Controller
{
    public function getListDownCentral(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'cid/list/'.$config, $dataBody);
    }

    public function addNewDownCentral(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'cid/add', $dataBody);
    }

    public function getDataDownCentral(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'cid/get-data/', $dataBody);
    }

    public function updateDownCentral(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'cid/update/'.$id, $dataBody);
    }

    public function deleteDownCentral(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'cid/delete/'.$id, $dataBody);
    }

    public function getProfileDownCentral(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'cid/data-profile/', $dataBody);
    }

    public function getUnmappingDownCentral(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'cid/unmapping-profile/', $dataBody);
    }

    public function updateProfileDownCentral(Request $request, $cid)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'cid/update-profile/'.$cid, $dataBody);
    }

    public function updateManyProfileDownCentral(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'cid/many-update-profile/', $dataBody);
    }

    public function filterDownCentral(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'cid/filter/', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'cid/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'cid/restore', $dataBody);
    }
}
