<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\SendConfig;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class Send extends SendConfig
{

    public function __construct (string $token) {
        $this->token = $token;
    }

    public function send_text (): string {
        $this->method = URLs::SEND_MESSAGE;

        $this->contentType = self::APPLICATION;
    }

}
