<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\SendParams;
use App\Libraries\GapAPI\Messages\Send;

/*
 * ta sare moshkele type params.
 *
 * dar asl code bayad in gune taghir konak ke:
 * ba har bar set shodane type params , curl monaseb
 * an load shavad.
 */

class GapAPI
{

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