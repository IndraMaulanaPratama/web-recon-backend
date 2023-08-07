<?php

namespace App\Http\Controllers\ProfileFee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileFeeController extends Controller
{
    public function getCountProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'profile/get-count-product', $dataBody);
    }

    public function getListProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;
        return $this->handlerControll('GET', 'profile/list/'.$config, $dataBody);
    }

    public function addNewProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');
        return $this->handlerControll('POST', 'profile/add', $dataBody);
    }

    public function getDataProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'profile/get-data', $dataBody);
    }

    public function updateProfile(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');
        return $this->handlerControll('PUT', 'profile/update/'.$id, $dataBody);
    }

    public function setDefaultProfile(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');
        return $this->handlerControll('PUT', 'profile/set-default/'.$id, $dataBody);
    }

    public function getDataCopyProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'profile/get-data-copy', $dataBody);
    }

    public function copyProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');
        return $this->handlerControll('POST', 'profile/copy', $dataBody);
    }

    public function deleteProfile(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');
        return $this->handlerControll('PUT', 'profile/delete/'.$id, $dataBody);
    }

    public function listProductProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'profile/list-product', $dataBody);
    }

    public function addProductProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');
        return $this->handlerControll('POST', 'profile/add-product', $dataBody);
    }

    public function getDataProductProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'profile/get-data-product', $dataBody);
    }

    public function updateProductProfile(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');
        return $this->handlerControll('PUT', 'profile/update-product/'.$id, $dataBody);
    }

    public function deleteProductProfile(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('DELETE', 'profile/delete-product/'.$id, $dataBody);
    }

    public function filterProfile(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'profile/filter/', $dataBody);
    }

    public function productUnexists(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;
        return $this->handlerControll('GET', 'profile/list-product-unexists'.$config, $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'profile/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'profile/restore', $dataBody);
    }
}
