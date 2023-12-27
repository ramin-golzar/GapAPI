<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class PaymentInquiry extends BaseSend
{

    public function __construct (object &$client , ?FormParams &$formParams , ?\App\Libraries\GapAPI\Handlers\Multipart &$multipart = null) {
        parent::__construct ($client , $formParams , $multipart);

        $this->set_method (URLs::payment_inquiry);
    }

}
