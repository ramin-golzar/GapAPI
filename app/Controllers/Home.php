<?php
namespace App\Controllers;

class Home extends BaseController
{

    public function index () {
        $gap = new \App\Libraries\GapAPI\GapAPI();

        $token = '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496';

        $gap->set_data ('THIS IS MY DATA');
        $gap->set_chat_id ('339322905');
        $gap->set_reply_keyboard ('example');

        $gapResponce = $gap->send_text ($token);
        $this->write_file ($_POST ['chat_id']);
//        $post = $this->request->getPost ();
//        $gapApi = new \App\Libraries\GapAPI\GapAPI();
//        if ($post ['type'] == 'join') {
//        $gapApi->send ($post ['chat_id']);
//        }
//        $this->send_text ($post ['chat_id']);
//        $this->write_file ('*** ' . $_POST ['chat_id'] . ' ***');
//        $this->send_image ($_POST ['chat_id']);
//        $this->send_message ($_POST['chat_id'] , 'text' , '🌼🌻🌺 Hello');
//        $this->send_phone ();
//        $this->send_location ();
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

    private function send_message (string $chat_id , string $type , string|array $data): void {
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

    private function send_phone (): void {
        $data = json_encode (['phone' => '091111111' , 'name' => 'HasanAli' ,]);

        $this->send_message ($_POST['chat_id'] , 'contact' , $data);
    }

    private function send_location (): void {
        $data = json_encode (['long' => '10.1222' , 'lat' => '20.5553' , 'desc' => 'Mshhad' ,]);

        $this->send_message ($_POST['chat_id'] , 'location' , $data);
    }

}
