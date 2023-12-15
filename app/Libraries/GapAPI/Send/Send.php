<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\SendConfig;
use App\Libraries\GapAPI\Send\Handlers\URLs;
use App\Libraries\GapAPI\Send\Handlers\PrepareParams;
use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Send\Handlers\Types;

class Send extends SendConfig
{

    public function __construct (string &$token) {
        parent::__construct ($token);
    }

    public function send_text (object $formParams): object {
        $this->method = URLs::SEND_MESSAGE;

        $this->set_type ($formParams , Types::text);

        $prepareParams = new PrepareParams();

        $this->formParams = $prepareParams->run ($formParams);

        return $this->request ();
    }

}
