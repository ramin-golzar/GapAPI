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

}
