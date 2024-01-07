<?php
namespace App\Controllers;

use App\Libraries\GapAPI\ReceiveTypes;

class Home extends BaseController
{

    public function index () {
        $token = '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496';

        $chatId = '339322905';

        $gap = new \App\Libraries\GapAPI\GapAPI ($token , $this->request);
//
//        $gap->set_chat_id ($chatId)
//            ->send_text ('LLLL');

        /* ----------------------------------------------------------------------
         * Step one of uploading
         * ----------------------------------------------------------------------
         */

        /* ToDo:
         * - a problem in the edit message
         * - escape the user inputs
         * - base64 encode & decode
         */

        $imagePath = FCPATH . '/Images/s.jpg';

//        $gap->set_chat_id ($chatId);


        $get = $gap->get_audio ();

        if ($get) {
            $gap->send_text ('this is a audio');
        } else {
            $gap->send_text ($gap->get_chat_id ());
        }



        /* -------------------------------------------------------------------------------- */

//        $this->write_file ('GAP');
//        $this->api ($chatId , $token , $imagePath);
    }

    private function api (string $chatId , string $token , string $imagePath): void {
        $api = new \App\Libraries\API\Api ($token);

        $api->sendImage ($chatId , $imagePath);
    }

    private function gapAPI (string $chatId , string $token , ?object $uploadImage = null): void {
        $img = '{"SID":"84c5f0cd5bb74870a8ab5e4ca2046a6b.jpg","filename":"s.jpg","filesize":845941,"type":"image","width":1024,"height":768,"duration":0,"desc":""}';
        log_message ('alert' , $uploadImage->getBody ());
        $sendMessageURL = 'sendMessage';

        $curl = \Config\Services::curlrequest ();

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded' ,
            ] ,
            'form_params' => [
                'chat_id' => $chatId ,
                'data' => $uploadImage->getBody () ,
                'type' => 'image' ,
            ] ,
        ];

        $ok = $curl->request ('POST' , $sendMessageURL , $options);
    }

    public function send_text (string $chatId): void {
        $client = \Config\Services::curlrequest ();

        $url = 'https://api.gap.im/sendMessage';

        $option = [
            'headers' => [
                'token' => '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496' ,
                'Content-Type' => 'application/x-www-form-urlencoded' ,
            ] ,
            'form_params' => [
                'chat_id' => $chatId ,
                'type' => 'text' ,
                'data' => 'Hello, Welcome to my robot' ,
            ] ,
        ];

        $response = $client->request ('POST' , $url , $option);

        $this->write_file ($response->getStatusCode ());
    }

    private function send_image (string $chatId): void {
        $uploadURL = 'https://api.gap.im/upload/';

        $imagePath = FCPATH . '/Images/s.jpg';

        $curl = \Config\Services::curlrequest ();

        $options = [
            'headers' => [
                'Content-Type' => 'multipart/form-data' ,
                'token' => '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496' ,
            ] ,
            'multipart' => [
                'chat_id' => $chatId ,
                'image' => new \CURLFile ($imagePath) ,
            ] ,
        ];

        $response = $curl->request ('POST' , $uploadURL , $options);

        $this->write_file ("Upload Code -> " . $response->getStatusCode ());

        /* -------------------------------------------------------------------------------- */


        $json = $response->getJSON ();

        $decoded = json_decode ($json , true);
        $decoded = json_decode ($decoded , true);
//        $decoded['desc'] = 'AAA';
        $encoded = json_encode ($decoded);

        $this->send_message ($_POST['chat_id'] , 'image' , $json);

        /* -------------------------------------------------------------------------------- */

//        $sendMessageUrl = 'https://api.gap.im/sendMessage/';
//        $sendMessageOptions = [
//            'headers' => [
//                'Content-Type' => 'application/x-www-form-urlencoded' ,
//                'token' => '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496' ,
//            ] ,
//            'form_params' => [
//                'chat_id' => $chatId ,
//                'type' => 'image' ,
//                'data' => json_encode ($decoded)
//            ] ,
//        ];
//        if ($response->getStatusCode () == 200) {
//        $response2 = $curl->request ('POST' , $sendMessageUrl , $sendMessageOptions);
//        }
//        $this->write_file ("\n\r\n\r" . 'Send Message Code: ' . $response->getStatusCode () . "\n\r\n\r");
    }

    private function send_message (
        string $chat_id , string $type , string|array $data
    ): void {
        $client = \Config\Services::curlrequest ();

        $url = 'https://api.gap.im/sendMessage/';

        $reply_keyboard = json_encode (['keyboard' => [[['start' => 'Start']]]]);

// 'Content-Type' => 'application/x-www-form-urlencoded' ,

        $options = [
            'headers' => [
                'token' => '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496' ,
            ] ,
        ];

        $options ['form_params'] = compact ('chat_id' , 'type' , 'data' , 'reply_keyboard');

        $response = $client->request ('POST' , $url , $options);

        $this->write_file ('Type: ' . $type . ' ->' . $response->getStatusCode ());
    }

    private function write_file ($text): void {
        $content = "\r\n $text \r\n";

        file_put_contents (WRITEPATH . 'uploads/sendtext.txt' , $content , FILE_APPEND);
    }

}
