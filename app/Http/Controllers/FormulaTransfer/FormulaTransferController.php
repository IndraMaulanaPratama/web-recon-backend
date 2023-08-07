<?php

namespace App\Http\Controllers\FormulaTransfer;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormulaTransferController extends Controller
{
    public function getList(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'formula-transfer/list/'.$config, $dataBody);
    }

    public function add(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'formula-transfer/add', $dataBody);
    }

    public function getData(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'formula-transfer/get-data', $dataBody);
    }

    public function updateData(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'formula-transfer/update/'.$id, $dataBody);
    }

    public function deleteData(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'formula-transfer/delete/'.$id, $dataBody);
    }

    public function filterData(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'formula-transfer/filter/', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'formula-transfer/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'formula-transfer/restore', $dataBody);
    }
}
