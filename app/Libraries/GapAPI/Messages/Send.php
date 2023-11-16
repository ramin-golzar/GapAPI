<?php
namespace App\Libraries\GapAPI\Messages;

use App\Libraries\GapAPI\SendParams;
use App\Libraries\GapAPI\URLs;

class Send
{

    private object $curl = null;
    private object $curlFile = null;
    private string $token = null;
    private object $sendParams = null;
    private array $form_params = null;

    public function __construct (SendParams $params , string $token) {
        $this->sendParams = $params;

        $this->token = $token;

        $this->providing ();
    }

    private function providing (): void {
        $this->provide_send_params ();

        $this->provide_form_params ();

        $this->provide_curl ();
    }

    private function provide_send_params (): void {
        $this->provide_chat_id ()
                . $this->provide_type ()
                . $this->provide_reply_keyboard ();
    }

    private function provide_chat_id (): object {
        $this->sendParams->chatId = $this->sendParams->chatId ?? esc ($this->request->getPost ('chat_id'));

        return $this;
    }

    private function provide_type (): object {
        $this->sendParams->type = $this->sendParams->type ?: 'text';

        return $this;
    }

    private function provide_reply_keyboard (): object {
        if ($this->sendParams->replyKeyboard) {
            $this->sendParams->replyKeyboard = json_encode (compact ($this->sendParams->replyKeyboard));
        }
    }

    private function provide_form_params (): void {
        $this->form_params = (array) $this->sendParams;

        foreach ($this->form_params as $k => $v) {
            if (is_null ($k)) {
                unset ($this->form_params [$k]);
            }
        }
    }

    private function provide_curl (): void {
        if ($this->sendParams->type == 'text') {
            $this->load_curl ();
        }
    }

    private function load_curl (): void {
        $options = [
            'token' => $this->token ,
        ];

        $this->curl = \Config\Services::curlrequest ($options);
    }

    public function request (): void {
        $response = $this->curl->request ('POST' , URLs::SEND_MESSAGE , compact ($this->form_params));
    }

}
