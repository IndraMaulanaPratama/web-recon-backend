<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DaysController extends Controller
{
    public function getCalendarDays(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');

            $response = $this->sendRequest('POST', 'calendar/list-day', $dataBody);
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

    public function addCalendarDays(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');
            $dataBody['created_by'] = $this->getName();
            $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

            $response = $this->sendRequest('POST', 'calendar/add-day', $dataBody);
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

    public function getDataDays(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');

            $response = $this->sendRequest('POST', 'calendar/get-data-day', $dataBody);
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

    public function updateDays(Request $request, $id)
    {
        try {
            $dataBody = $request->except('user_login');
            $dataBody['modified_by'] = $this->getName();
            $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

            $response = $this->sendRequest('PUT', 'calendar/update-day/'.$id, $dataBody);
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

    public function deleteDays(Request $request, $id)
    {
        try {
            $dataBody = $request->except('user_login');
            $dataBody['deleted_by'] = $this->getName();
            $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

            $response = $this->sendRequest('DELETE', 'calendar/delete-day/'.$id, $dataBody);
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
}
