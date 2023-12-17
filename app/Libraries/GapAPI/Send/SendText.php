<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\BaseSend;
use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\Types;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class SendText extends BaseSend
{

    public function __construct (object &$client , ?FormParams $formParams , ?Multipart $multipart = null) {
        $this->set_method (URLs::SEND_ACTION);

        $this->set_type (Types::text);

        return parent::__construct ($client , $formParams , $multipart);
    }

}
