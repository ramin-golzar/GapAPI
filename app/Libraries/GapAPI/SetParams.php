<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\Handlers\FormParams;

class SetParams
{

    protected FormParams $formParams;

    public function __construct () {
        $this->formParams = new FormParams();
    }

    public function set_chat_id (string|int $chatId): void {
        $this->formParams->chat_id = $chatId;
    }

    protected function set_data (string $data): void {
        $this->formParams->data = $data;
    }

    protected function set_contact (string &$phone , string &$name): void {
        $data = [
            'phone' => $phone ,
            'name' => $name ,
        ];

        $this->formParams->data = json_encode ($data);
    }

    protected function set_location (string &$lat , string &$long , string &$description): void {
        $data = [
            'lat' => $lat ,
            'lang' => $long ,
            'desc' => $description ,
        ];

        $this->formParams->data = json_encode ($data);
    }

    protected function set_text (string &$text): void {
        $this->formParams->text = $text;
    }

    protected function set_callback_id (string &$callbackId): void {
        $this->formParams->callback_id = $callbackId;
    }

    protected function set_show_alert (bool $showAlert): void {
        $this->formParams->show_alert = $showAlert;
    }

    public function set_reply_keyboard (string|array $replyKeyboard): void {
        $this->formParams->reply_keyboard = $replyKeyboard;
    }

    public function set_inline_keyboard (string|array $inlineKeyboard): void {
        $this->formParams->inline_keyboard = $inlineKeyboard;
    }

    public function set_form (string|array $form): void {
        $this->formParams->form = $form;
    }

}
