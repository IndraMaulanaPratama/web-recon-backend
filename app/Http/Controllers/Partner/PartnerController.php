<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function getListPartner(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'partner/list/'.$config, $dataBody);
    }

    public function addNewPartner(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'partner/add', $dataBody);
    }

    public function getDataPartner(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'partner/get-data', $dataBody);
    }

    public function updatePartner(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'partner/update/'.$id, $dataBody);
    }

    public function deletePartner(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'partner/delete/'.$id, $dataBody);
    }

    public function listCidPartner(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'partner/list-cid', $dataBody);
    }

    public function addCidPartner(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'partner/add-cid', $dataBody);
    }

    public function deleteCidPartner(Request $request, $id)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('DELETE', 'partner/delete-cid/'.$id, $dataBody);
    }

    public function unmappingCidPartner(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'partner/unmapping-cid/', $dataBody);
    }

    public function addUnmappingPartner(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'partner/add-unmapping-cid', $dataBody);
    }

    public function filterPartner(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'partner/filter/', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'partner/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'partner/restore', $dataBody);
    }
}
