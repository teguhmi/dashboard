<?php

namespace App\Http\Controllers\srs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QueryQontak extends Controller
{
    public function login()
    {
        try {
            $data = array(
                'username' => 'teguhmi@ecampus.ut.ac.id',
                'password' => '?Tri9una32',
                'grant_type' => 'password',
                'client_id' => 'RRrn6uIxalR_QaHFlcKOqbjHMG63elEdPTair9B9YdY',
                'client_secret' => 'Sa8IGIh_HpVK1ZLAF0iFf7jU760osaUNV659pBIZR00'
            );

            $url = "https://service-chat.qontak.com/oauth/token";
            $client = new \GuzzleHttp\Client();
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                'body' => json_encode($data)
            ]);
            $body = $response->getBody();
            return json_decode($body);

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function sendWA($data_array)
    {
        $data = array(
            'to_number' => $data_array['hp'],
            'to_name' => $data_array['name'],
            'message_template_id' => '710c7cc2-65d3-4c1c-935e-a102a6b0355c',
            'channel_integration_id' => '430e036e-af32-4b06-bc36-ec33ba2d356f',
            'language' => [
                "code" => "id"
            ],
            'parameters' => [
                'body' => [
                    [
                        'key' => '1',
                        'value' => 'full_name',
                        'value_text' => $data_array['name']
                    ],
                    [
                        'key' => '2',
                        'value' => 'user',
                        'value_text' => $data_array['user']
                    ],
                    [
                        'key' => '3',
                        'value' => 'password',
                        'value_text' => $data_array['pass']
                    ]
                ]
            ]
        );

        $login = self::login();
        $token = $login->access_token;
        if (empty($token)) {
            echo "Error";
        } else {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
        }
        $url = "https://service-chat.qontak.com/api/open/v1/broadcasts/whatsapp/direct";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => $headers,
            'body' => json_encode($data)
        ]);
        $body = $response->getBody();
        $obj = json_decode($body);
        if ($obj->status == 'success') {
            $data = array(
                'idSMS' => $obj->data->id
            );
        }
        return json_decode($body);
    }
}
