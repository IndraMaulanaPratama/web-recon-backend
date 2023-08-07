<?php

namespace App\Http\Controllers\ReconDana;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReconDanaController extends Controller
{
    public function unmappingBiller(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'recon-dana/unmapping-biller', $dataBody);
    }

    public function unmappingProduct(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'recon-dana/unmapping-product', $dataBody);
    }

    public function addBiller(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'recon-dana/add-biller', $dataBody);
    }

    public function addProduct(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'recon-dana/add-product', $dataBody);
    }

    public function process(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['user_process'] = $this->getName();

        return $this->handlerControll('POST', 'recon-dana/process', $dataBody);
    }

    public function listCorrectionProcess(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'recon-dana/list-correction-process', $dataBody);
    }

    public function updateCorrectionProcess(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'recon-dana/update-correction-process', $dataBody);
    }

    public function listSuspectProcess(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'recon-dana/list-suspect-process', $dataBody);
    }

    public function updateSuspect(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'recon-dana/update-suspect-process', $dataBody);
    }

    public function listSummary(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('GET', 'recon-dana/list-summary', $dataBody);
    }

    public function list(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'recon-dana/list', $dataBody);
    }

    public function filter(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'recon-dana/filter', $dataBody);
    }

    public function listCorrection(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/list-correction', $dataBody);
    }

    public function listSuspect(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/list-suspect', $dataBody);
    }

    public function byId(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/by-id', $dataBody);
    }

    public function byIdSuspect(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/by-id-suspect', $dataBody);
    }

    public function listSuspectProduct(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/list-suspect-product', $dataBody);
    }

    public function byProduct(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/by-product', $dataBody);
    }

    public function listByCid(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/by-cid', $dataBody);
    }

    public function history(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/history', $dataBody);
    }

    public function diffTransfer(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/get-diff-transfer', $dataBody);
    }

    public function addDiffTransfer(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();

        return $this->handlerControll('POST', 'recon-dana/add-diff-transfer', $dataBody);
    }

    public function getTransfer(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-dana/get-transfer', $dataBody);
    }

    public function addTransfer(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['user_process'] = $this->getName();

        return $this->handlerControll('POST', 'recon-dana/add-transfer', $dataBody);
    }

    public function checkStatus(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['user_process'] = $this->getName();

        return $this->handlerControll('POST', 'recon-dana/check-status', $dataBody);
    }

    public function checkMutation(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['user_process'] = $this->getName();

        return $this->handlerControll('POST', 'recon-dana/check-mutation', $dataBody);
    }
}
