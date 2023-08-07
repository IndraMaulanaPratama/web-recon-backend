<?php

namespace App\Http\Controllers\GroupTransferFunds;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GtfController extends Controller
{
    public function getListGtf(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'group-funds/list/'.$config, $dataBody);
    }

    public function addNewGtf(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'group-funds/add', $dataBody);
    }

    public function getDataGtf(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'group-funds/get-data', $dataBody);
    }

    public function updateGtf(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'group-funds/update/'.$id, $dataBody);
    }

    public function deleteGtf(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'group-funds/delete/'.$id, $dataBody);
    }

    public function listProductGtf(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'group-funds/list-product', $dataBody);
    }

    public function listAddProductGtf(Request $request, $config)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'group-funds/list-add-product/' .$config, $dataBody);
    }

    public function addProductGtf(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'group-funds/add-product', $dataBody);
    }

    public function deleteProductGtf(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('DELETE', 'group-funds/delete-product/'.$id, $dataBody);
    }

    public function filterGtf(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'group-funds/filter/', $dataBody);
    }

    public function byBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'group-funds/by-biller', $dataBody);
    }

    public function getAmount(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'group-funds/get-amount', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'group-funds/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'group-funds/restore', $dataBody);
    }
}
