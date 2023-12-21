<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\Handlers\Types;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class Contact extends BaseSend
{

    public function __construct (object &$client , ?\App\Libraries\GapAPI\Handlers\FormParams &$formParams , ?\App\Libraries\GapAPI\Handlers\Multipart &$multipart = null) {
        parent::__construct ($client , $formParams , $multipart);

        $this->set_type (Types::contact);

        $this->set_method (URLs::send_message);
    }

}
