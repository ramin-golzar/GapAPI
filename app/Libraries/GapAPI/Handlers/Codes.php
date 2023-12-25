<?php
namespace App\Libraries\GapAPI\Handlers;

class Codes
{

    /**
     * To get user chatID
     *
     * @return string|null
     */
    public function get_chat_id (): string|null {
        return esc ($this->request->getPost ('chat_id')) ?: null;
    }

    public function base64 (string $chatId): string {
        return base64_encode ($chatId);
    }

}
