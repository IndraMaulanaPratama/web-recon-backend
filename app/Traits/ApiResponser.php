<?php

namespace App\Traits;

trait ApiResponser
{
    public function generalResponse($code, $message, ...$data)
    {
        // Inisialisasi Variable
        $response = [
            'result_code' => $code,
            'result_message' => $message,
        ];

        // Maping Data Jika Ditemukan
        if (null != $data) :
            $data = ['result_data' => $data[0]];
            $response = array_merge($response, $data);
        endif;

        // Kembalikan Response
        return response()->json(
            $response,
            $code,
        );
    }

    public function configResponse($code, $message, $data, $config)
    {
        // Inisialisasi Variable
        $response = [
            'result_code' => $code,
            'result_message' => $message,
            'config' => $config,
            'result_data' => $data,
        ];

        // Kembalikan Response
        return response()->json(
            $response,
            $code,
        );
    }

    public function invalidValidation(...$data)
    {
        if (null == $data) {
            $response = [
              'result_code' => 400,
              'result_message' => 'Invalid Data Validation',
            ];
        } else {
            $response = [
              'result_code' => 400,
              'result_message' => 'Invalid Data Validation',
              'result_data' => $data[0],
            ];
        }

        return response()->json(
            $response,
            400,
        );
    }

    public function responseNotFound($message)
    {
        return response()->json(
            [
                'result_code' => 404,
                'result_message' => $message,
            ],
            404
        );
    }


    public function failedResponse($message)
    {
        $response = [
          'result_code' => 500,
          'result_message' => $message,
        ];

        return response()->json(
            $response,
            500
        );
    }
}
