<?php
namespace App\Controllers;

class Home extends BaseController
{

    public function index () {
        $post = $this->request->getPost ();

//        $gapApi = new \App\Libraries\GapAPI\GapAPI();
//        if ($post ['type'] == 'join') {
//        $gapApi->send ($post ['chat_id']);
//        }
//        $this->sendText ($post ['chat_id']);

        $this->sendImage ($post ['chat_id']);
    }

    public function sendText (string $chatId): void {
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

        $this->write_file ($response->getStatusCode ());
    }

    private function sendImage (string $chatId): void {
        $client = \Config\Services::curlrequest ();

        $url = 'https://api.gap.im/sendMessage/';

        $ngrokUrl = 'http://9ef2-151-240-171-155.ngrok-free.app/my_projects/GitHub/GapAPI/public/Images/image_1.jpg';

        $uploadUrl = 'https://api.gap.im/upload/';

        $writePath = new \CURLFile (WRITEPATH . 'uploads/Images/image_1.jpg');
        $baseUrl = new \CURLFile (base_url ('Images/image_1.jpg'));
        $publicPath = new \CURLFile (PUBLICPATH . 'Images/image_1.jpg');

        $option = [
            'headers' => [
                'content-type' => 'mutipart/form-data' ,
                'token' => '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496' ,
            ] ,
            'multipart' => [
                'chat_id' => $chatId ,
                'image' => $writePath ,
            ] ,
        ];

        $response = $client->request ('POST' , $uploadUrl , $option);

        $this->write_file ($response->getStatusCode ());
    }

    private function write_file (string $text): void {
        file_put_contents (WRITEPATH . 'uploads/sendtext.txt' , $text));
    }

}
