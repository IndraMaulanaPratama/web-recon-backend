<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'product-module/list/'.$config, $dataBody);
    }

    public function show(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'product-module/get-data/', $dataBody);
    }

    public function store(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'product-module/add', $dataBody);
    }

    public function update(Request $request, $name)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'product-module/update/'.$name, $dataBody);
    }

    public function destroy(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'product-module/delete/'.$id, $dataBody);
    }

    public function getCount(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'product-module/get-count', $dataBody);
    }

    public function filter(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'product-module/filter', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'product-module/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'product-module/restore', $dataBody);
    }

    public function deleteData(Request $request, $id)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('DELETE', 'product-module/delete/'.$id, $dataBody);
    }

    public function testData(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'product-module/test-data', $dataBody);
    }

    public function dataColumn(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'product-module/data-column', $dataBody);
    }
}
