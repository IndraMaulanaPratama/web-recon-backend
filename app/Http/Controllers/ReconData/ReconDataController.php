<?php

namespace App\Http\Controllers\ReconData;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use SimpleXMLElement;

use function PHPUnit\Framework\returnSelf;

class ReconDataController extends Controller
{
    public function list(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'recon-data/list', $dataBody);
    }

    public function filter(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('GET', 'recon-data/filter/', $dataBody);
    }

    public function settledProduct(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-data/settled', $dataBody);
    }

    public function listSuspect(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-data/list-suspect', $dataBody);
    }

    public function listByProduct(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-data/by-product', $dataBody);
    }

    public function listByCid(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-data/by-cid', $dataBody);
    }

    public function listByHistory(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-data/history', $dataBody);
    }

    public function export(Request $request)
    {
        $dataBody = $request->except('user_login');
        return $this->handlerControll('POST', 'recon-data/export', $dataBody);
    }

    public function download(Request $request, $id)
    {
        $dataBody = $request->except('user_login');
        $method = 'GET';
        $address = 'recon-data/export-download/'. $id;

        $client = new Client($this->configAddress());

        try {
            $response = $client->request(
                $method,
                $address,
                [
                    'headers' => $this->credentialsHeader(),
                    'json' => $dataBody,
                ]
            );
        } catch (RequestException $th) {
            $response = $th->getResponse();
            $contents = $response->getBody()->getContents();
            $status = $response->getStatusCode();

            if (400 == $status && 404 == $status) :
                return response()->json(
                    [
                    'result_code' => $status,
                    'result_message' => $response->getReasonPhrase(),
                    ],
                    $status
                );
            else :
                return response()->json(
                    json_decode($contents),
                    $status
                );
            endif;
        }

        // Get Data 202
        $warning = json_decode($response->getBody());

        // Validasi Response 202
        if (false != $warning) :
            return $warning;
        endif;

        // Return Xml file
        return $response->getBody();
    }
}
