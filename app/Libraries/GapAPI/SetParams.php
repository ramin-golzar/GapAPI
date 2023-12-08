<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\Handlers\Params;

class SetParams
{

    private object $params = null;

    public function __construct () {
        $this->params = new Params();
    }

    public function set_chat_id (string|int $chatId): void {
        $this->params->chat_id = $chatId;
    }

    public function set_type (string $type): void {
        $this->params->type = $type;
    }

    public function set_data (string $data): void {
        $this->params->data = $data;
    }

    public function set_reply_keyboard (string|array $replyKeyboard): void {
        $this->params->reply_keyboard = $replyKeyboard;
    }

    public function set_inline_keyboard (string $inlineKeyboard): void {
        $this->params->inline_keyboard = $inlineKeyboard;
    }

    public function set_form (string $form): void {
        $this->params->form = $form;
    }

}

//<#assign licenseFirst = "/* ">
//<#assign licensePrefix = " * ">
//<#assign licenseLast = " */">