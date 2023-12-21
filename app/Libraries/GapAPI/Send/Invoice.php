<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Send\Handlers\Types;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class Invoice extends BaseSend
{

    public function __construct (object &$client , ?FormParams &$formParams , ?Multipart &$multipart = null) {
        parent::__construct ($client , $formParams , $multipart);

        $this->set_method (URLs::invoice);
    }

}
