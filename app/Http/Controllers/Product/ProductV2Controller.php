<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductV2Controller extends Controller
{
    public function index(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'product/list/'.$config, $dataBody);
    }

    public function show(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'product/get-data/', $dataBody);
    }

    public function store(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'product/add', $dataBody);
    }

    public function update(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'product/update/', $dataBody);
    }

    public function destroy(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'product/delete/', $dataBody);
    }

    public function getCount(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'product/get-count', $dataBody);
    }

    public function filter(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'product/filter', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'product/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'product/restore', $dataBody);
    }

    public function deleteData(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('DELETE', 'product/delete/', $dataBody);
    }
}
