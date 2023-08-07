<?php

namespace App\Http\Controllers\Correction;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CorrectionController extends Controller
{
    public function getList(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'correction/list/'.$config, $dataBody);
    }

    public function add(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'correction/add', $dataBody);
    }

    public function getData(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'correction/get-data', $dataBody);
    }

    public function update(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'correction/update/'.$id, $dataBody);
    }

    public function delete(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'correction/delete/'.$id, $dataBody);
    }

    public function filter(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'correction/filter/', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'correction/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'correction/restore', $dataBody);
    }
}
