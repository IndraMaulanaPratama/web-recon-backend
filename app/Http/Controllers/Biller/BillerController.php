<?php

namespace App\Http\Controllers\Biller;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillerController extends Controller
{
    public function getListBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'biller/list/'.$config, $dataBody);
    }

    public function getGopBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'biller/list-gop/'.$config, $dataBody);
    }

    public function addNewBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/add', $dataBody);
    }

    public function getDataBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/get-data', $dataBody);
    }

    public function updateBiller(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'biller/update/'.$id, $dataBody);
    }

    public function deleteBiller(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'biller/delete/'.$id, $dataBody);
    }

    public function listAccountBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/list-account', $dataBody);
    }

    public function dataAccountBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/data-account', $dataBody);
    }

    public function addAccountBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/add-account', $dataBody);
    }

    public function deleteAccountBiller(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('DELETE', 'biller/delete-account/'.$id, $dataBody);
    }

    public function listProductBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/list-product', $dataBody);
    }

    public function listAddProductBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/list-add-product', $dataBody);
    }

    public function addProductBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/add-product', $dataBody);
    }

    public function deleteProductBiller(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('DELETE', 'biller/delete-product/'.$id, $dataBody);
    }
    public function listCalendarBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/list-calendar', $dataBody);
    }

    public function dataCalendarBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/data-calendar', $dataBody);
    }

    public function addCalendarBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/add-calendar', $dataBody);
    }

    public function deleteCalendarBiller(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('DELETE', 'biller/delete-calendar/'.$id, $dataBody);
    }

    public function filterDataBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'biller/filter', $dataBody);
    }

    public function listByGop(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'biller/by-gop', $dataBody);
    }

    public function billerListModul(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'biller/list-modul/'.$config, $dataBody);
    }

    public function listAddAccount(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'biller/list-add-account', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'biller/trash', $dataBody);
    }

    public function unmappingProfile(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'biller/unmapping-profile', $dataBody);
    }

    public function updateProfile(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'biller/update-profile/'.$id, $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'biller/restore/', $dataBody);
    }
}
