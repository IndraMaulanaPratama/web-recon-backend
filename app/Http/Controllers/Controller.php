<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponser;
use GuzzleHttp\Exception\RequestException;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
    use ApiResponser;

    public function getUriRest()
    {
        // *** Stagging URL ***
        // return 'http://10.168.26.19/api/';

        // *** Local URL ***
        // return 'http://127.0.0.1:8000/api/';

        return env('TARGET_URL', 'http://127.0.0.1:8000/api/');
    }

    public function credentialsHeader()
    {
        // Akses sebagai autorecon
        return [
            'Authorization' => 'Bearer 2|2TFXz3WgcT305sAkbExLbCQeENiwLhqk0yJsYvCcTrUk9hSxAITVojgQI0JH',
            'x-auth-key' => 'bdbbc9c0-574a-4bfa-aeaf-7bdb9b407b0c',
        ];
    }

    public function configAddress()
    {
        return [
            'base_uri' => $this->getUriRest(),
            'timeout' => 60,
            'allow_redirects' => true,
        ];
    }

    /**
     * Function Send request Sudah Di optimalisasi
     * Function penggantinya adalah Handler Controll
     * Selanjutnya semua controller akan di migrasi
     * Dari Send Request menjadi Handler Controller
     */
    public function sendRequest($method, $address, $dataBody)
    {
        $client = new Client($this->configAddress());
        $response = $client
        ->request(
            $method,
            $address,
            [
                'headers' => $this->credentialsHeader(),
                'json' => $dataBody,
            ]
        );
        return json_decode($response->getBody());
    }

    public function throwException($data)
    {
        return json_decode(
            $data->getResponse()
            ->getBody()
            ->getContents()
        );
    }

    public function getName()
    {
        return Auth::user()->name;
    }

    public function getUsername()
    {
        return Auth::user()->username;
    }

    public function getIdUser()
    {
        return Auth::user()->id;
    }

    public function addIndexNumber($data)
    {
        $countData = count($data);
        for ($i=0; $i < $countData; $i++) {
            $data[$i] = collect($data[$i]);
            $data[$i]->put('INDEX_NUMBER', $i);
        }

        return $data;
    }

    public function handlerControll($method, $address, $dataBody)
    {
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

        return json_decode($response->getBody());
    }
}
