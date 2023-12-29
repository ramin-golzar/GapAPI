<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Send\Handlers\Types;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class Action extends BaseSend
{

    public function __construct (object &$client , ?FormParams &$formParams) {
        parent::__construct ($client , $formParams);

        $this->set_type (Types::typing);

        $this->set_method (URLs::send_action);
    }

}
