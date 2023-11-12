<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\URLs;
use App\Libraries\GapAPI\SendParams;

class GapAPI
{

    private $URLs = null;
    private $token = null;

    public function __construct (string $token) {
        $this->token = $token;

        $this->URLs = new URLs();
    }

    public function send_joinmsg (string|array $keyboard , string $textMsg = null): void {

    }

    public function send_textmsg (SendParams $params): void {

    }

}

// this code fot test the connection
/*
    public function send (string $chatId): void {
        $client = \Config\Services::curlrequest ();

        $url = 'https://api.gap.im/sendMessage/';

        $option = [
            'headers' => [
                'token' => '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496' ,
            ] ,
            'form_params' => [
                'chat_id' => $chatId ,
                'type' => 'text' ,
                'data' => 'Hello, Welcome to my robot' ,
            ] ,
        ];

        $response = $client->request ('POST' , $url , $option);
    }
 */