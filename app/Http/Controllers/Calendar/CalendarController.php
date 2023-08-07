<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function viewDetailCalendar(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'calendar/view', $dataBody);
    }

    public function getListCalendar(Request $request)
    {
        $dataBody = $request->except('user_login');
        $config = $request->config;

        return $this->handlerControll('GET', 'calendar/list/'.$config, $dataBody);
    }

    public function addNewCalendar(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'calendar/add', $dataBody);
    }

    public function getDataCalendar(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'calendar/get-data', $dataBody);
    }

    public function updateCalendar(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'calendar/update/'.$id, $dataBody);
    }

    public function setDefaultCalendar(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['modified_by'] = $this->getName();
        $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'calendar/set-default/'.$id, $dataBody);
    }

    public function getAllCopyCalendar(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('POST', 'calendar/get-data-copy', $dataBody);
    }

    public function addCopyCalendar(Request $request)
    {
        $dataBody = $request->except('user_login');
        $dataBody['created_by'] = $this->getName();
        $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('POST', 'calendar/copy', $dataBody);
    }

    public function deleteCalendar(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $dataBody['deleted_by'] = $this->getName();
        $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

        return $this->handlerControll('PUT', 'calendar/delete/'.$id, $dataBody);
    }

    public function filterCalendar(Request $request)
    {
        $dataBody = $request->except('user_login');

        return $this->handlerControll('GET', 'calendar/filter/', $dataBody);
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'calendar/trash', $dataBody);
    }

    public function restore(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'calendar/restore', $dataBody);
    }
}
