<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\SendConfig;
use App\Libraries\GapAPI\Send\Handlers\URLs;
use App\Libraries\GapAPI\Send\Handlers\PrepareParams;

class Send extends SendConfig
{

    public function __construct (string &$token) {
        parent::__construct ($token);
    }

    public function send_text (object $formParams): object {
        $this->method = URLs::SEND_MESSAGE;

        $prepareParams = new PrepareParams();

        $this->form_params = $prepareParams->run ($formParams);

        return $this->request ();
    }

}
