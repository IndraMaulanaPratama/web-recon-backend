<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{
    public function __construct($status, $message, ...$data)
    {
        self::wrap('');
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
    public function toArray($request)
    {
        // return parent::toArray($request);
        if (null == $this->data) {
            $response = [
                'result_code' => $this->status,
                'result_message' => $this->message,
            ];
        } else {
            $response = [
                'result_code' => $this->status,
                'result_message' => $this->message,
                'result_data' => $this->data[0],
            ];
        }

        return $response;
    }
}
