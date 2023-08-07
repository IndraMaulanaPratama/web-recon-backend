<?php

namespace App\Http\Controllers\ExcludePartner;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExcludePartnerController extends Controller
{
    public function getListEp(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');
            $config = $request->config;

            $response = $this->sendRequest('GET', 'exclude-partner/list/'.$config, $dataBody);
            return response()->json(
                $response,
                $response->result_code,
            );
        } catch (\Throwable $th) {
            $response = $this->throwException($th);
            return response()->json(
                $response,
                // $dataBody,
                $response->result_code
            );
        }
    }

    public function addNewEp(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');
            $dataBody['created_by'] = $this->getName();
            $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

            $response = $this->sendRequest('POST', 'exclude-partner/add', $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $response = $this->throwException($th);
            return response()->json(
                $response,
                $response->result_code
            );
        }
    }

    public function deleteEp(Request $request, $id)
    {
        try {
            $dataBody = $request->except('user_login');
            $dataBody['deleted_by'] = $this->getName();
            $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

            $response = $this->sendRequest('DELETE', 'exclude-partner/delete/'.$id, $dataBody);
            return response()->json(
                $response
            );
        } catch (\Throwable $th) {
            $response = $this->throwException($th);
            return response()->json(
                $response,
                $response->result_code
            );
        }
    }

    public function filterEp(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');

            $response = $this->sendRequest('GET', 'exclude-partner/filter/', $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $response = $this->throwException($th);
            return response()->json(
                $response,
                $response->result_code
            );
        }
    }
}
