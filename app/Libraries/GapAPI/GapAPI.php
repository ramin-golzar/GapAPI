<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\Send\SendText;
use App\Libraries\GapAPI\SetParams;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class GapAPI extends SetParams
{

    /**
     * This is cURL object
     *
     * @var object
     */
    private object $client;

    public function __construct (string &$token) {
        parent::__construct ();

        $this->client = \Config\Services::curlrequest ($this->get_base_options ($token));
    }

    /**
     * Return the base options for cURL
     *
     * @return array
     */
    private function get_base_options (string &$token): array {
        return [
            'headers' => [
                'token' => $token ,
            ] ,
            'baseURI' => URLs::BASE_URL ,
        ];
    }

    /**
     * Sending evetything except upload file
     *
     * @param string $token
     * @return object
     */
    public function send_text (): object {
        return new SendText ($this->client , $this->formParams);
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