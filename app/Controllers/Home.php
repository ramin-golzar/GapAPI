<?php
namespace App\Controllers;

class Home extends BaseController
{

    public function index () {


        $post = $this->request->getPost ();

        if ($post ['type'] == 'join') {
            $this->send ($post ['chat_id']);
        }
    }

    private function send (string $chatId): void {
        $client = \Config\Services::curlrequest ();

        $url = 'https://api.gap.im/sendMessage';

        $option = [
            'headers' => [
                'token' => '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496' ,
            ] ,
            'form_params' => [
                'char_id' => $chatId ,
                'type' => 'text' ,
                'data' => 'Hello, Welcome to my robot' ,
            ] ,
        ];

        $response = $client->request ('POST' , $url , $option);
    }

}
