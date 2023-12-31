<?php
namespace App\Libraries\GapAPI\Receive;

class Receive
{

    private object $request;

    public function __construct (object $request) {
        $this->request = (object) $request->getPost ();
    }

    public function get_chat_id (): string|false {
        return $this->request->chat_id ?: false;
    }

}
