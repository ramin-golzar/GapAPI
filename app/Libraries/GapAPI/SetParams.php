<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\Handlers\FormParams;

class SetParams
{

    private FormParams $formParams;

    public function set_chat_id (string|int $chatId): void {
        $this->formParams->chat_id = $chatId;
    }

    public function set_type (string $type): void {
        $this->formParams->type = $type;
    }

    public function set_data (string $data): void {
        $this->formParams->data = $data;
    }

    public function set_reply_keyboard (string|array $replyKeyboard): void {
        $this->formParams->reply_keyboard = $replyKeyboard;
    }

    public function set_inline_keyboard (string $inlineKeyboard): void {
        $this->formParams->inline_keyboard = $inlineKeyboard;
    }

    public function set_form (string $form): void {
        $this->formParams->form = $form;
    }

}
