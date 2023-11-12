<?php
namespace App\Libraries\GapAPI\Messages;

use App\Libraries\GapAPI\SendParams;

class Send
{

    private string $token = null;

    public function __construct (SendParams $params , string $token) {
        $this->token = $token;
    }

    public function send_text (SendParams $params): void {

    }

}
