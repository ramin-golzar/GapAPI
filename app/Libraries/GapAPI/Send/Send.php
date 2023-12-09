<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\SendConfig;
use App\Libraries\GapAPI\Send\Handlers\URLs;
use App\Libraries\GapAPI\Send\Handlers\PrepareParams;

class Send extends SendConfig
{

    public function __construct (string $token) {
        $this->set_token ($token);
    }

    public function send_text (): string {
        $this->method = URLs::SEND_MESSAGE;

        $this->set_content_type (self::APPLICATION);

        $prepareParams = new PrepareParams();

        $this->form_params = $prepareParams->run ();
    }

}
