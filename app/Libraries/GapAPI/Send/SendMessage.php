<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\BaseSend;
use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\Types;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class SendMessage extends BaseSend
{

    public function __construct (object &$client , ?FormParams &$formParams , ?Multipart &$multipart = null) {
        parent::__construct ($client , $formParams , $multipart);

        $this->set_method (URLs::send_message);

        $this->set_type (Types::text);

        return $this->request ();
    }

}
