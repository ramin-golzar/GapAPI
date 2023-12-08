<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\SendConfig;

class Send extends SendConfig
{

    public function __construct (string $token) {
        $this->token = $token;
    }

    public function send_text (): string {

    }

}
