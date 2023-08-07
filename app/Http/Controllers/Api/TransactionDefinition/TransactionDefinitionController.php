<?php

namespace App\Http\Controllers\Api\TransactionDefinition;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponser;
use Carbon\Carbon;

class TransactionDefinitionController extends Controller
{
    use ApiResponser;

    public function index(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');
            $config = $request->config;

            $response = $this->sendRequest('GET', 'product/list/'.$config, $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $result = $this->throwException($th);
            return response()->json(
                $result,
                $result->result_code
            );
        }
    }

    public function getDataProduct(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');

            $response = $this->sendRequest('POST', 'product/get-data/', $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $result = $this->throwException($th);
            return response()->json(
                $result,
                $result->result_code
            );
        }
    }

    public function addNewProduct(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');
            $dataBody['created_by'] = $this->getName();
            $dataBody['created_at'] = Carbon::now('Asia/Jakarta');

            $response = $this->sendRequest('POST', 'product/add', $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $result = $this->throwException($th);
            return response()->json(
                $result,
                $result->result_code
            );
        }
    }

    public function filterProduct(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');

            $response = $this->sendRequest('GET', 'product/filter', $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $result = $this->throwException($th);
            return response()->json(
                $result,
                $result->result_code
            );
        }
    }

    public function updateProduct(Request $request, $name)
    {
        try {
            $dataBody = $request->except('user_login');
            $dataBody['modified_by'] = $this->getName();
            $dataBody['modified_at'] = Carbon::now('Asia/Jakarta');

            $response = $this->sendRequest('PUT', 'product/update/'.$name, $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $result = $this->throwException($th);
            return response()->json(
                $result,
                $result->result_code
            );
        }
    }

    public function deleteProduct(Request $request, $id)
    {
        try {
            $dataBody = $request->except('user_login');
            $dataBody['deleted_by'] = $this->getName();
            $dataBody['deleted_at'] = Carbon::now('Asia/Jakarta');

            $response = $this->sendRequest('PUT', 'product/delete/'.$id, $dataBody);
            return response()->json(
                $response
            );
        } catch (\Throwable $th) {
            $result = $this->throwException($th);
            return response()->json(
                $result,
                $result->result_code
            );
        }
    }

    public function getCountProduct(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');

            $response = $this->sendRequest('GET', 'product/get-count', $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $result = $this->throwException($th);
            return response()->json(
                $result,
                $result->result_code
            );
        }
    }

    public function listColumnProduct(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');

            $response = $this->sendRequest('POST', 'product/data-column', $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $result = $this->throwException($th);
            return response()->json(
                $result,
                $result->result_code
            );
        }
    }

    public function testDataProduct(Request $request)
    {
        try {
            $dataBody = $request->except('user_login');

            $response = $this->sendRequest('POST', 'product/test-data', $dataBody);
            return response()->json(
                $response,
                $response->result_code
            );
        } catch (\Throwable $th) {
            $result = $this->throwException($th);
            return response()->json(
                $result,
                $result->result_code
            );
        }
    }

    public function trash(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'product/trash', $dataBody);
    }
}
