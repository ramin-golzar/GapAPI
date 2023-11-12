<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\SendParams;
use App\Libraries\GapAPI\Messages\Send;

class GapAPI
{

    private object $sendParams = null;
    private $token = null;

    public function __construct (string $token = null) {
        $this->set_token ($token);

        $this->sendParams = new SendParams();
    }

    private function set_token (string $token): void {
        if ($token) {
            $this->token = $token;
        }
    }

    public function send_join_msg (SendParams $params): void {

    }

    public function send_message (): void {
        $send = new Send ($this->sendParams , $this->token);
    }

    public function set_chat_id (string $chatId = null): object {
        $this->sendParams->chatId = $chatId;

        return $this;
    }

    public function set_type (string $type = 'text'): object {
        $this->sendParams->type = $type;

        return $this;
    }

    public function set_data (string $data): object {
        $this->sendParams->data = $data;

        return $this;
    }

    public function set_reply_keyboard (string|array $keyboard = null): object {
        $this->sendParams->replyKeyboard = $keyboard;

        return $this;
    }

    public function set_inline_keyboard (string|array $keyboard = null): object {
        $this->sendParams->inlineKeyboard = $keyboard;

        return $this;
    }

    public function set_form (string|array $form = null): object {
        $this->sendParams->form = $form;

        return $this;
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