<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class PaymentInquiry extends BaseSend
{

    public function __construct (object &$client , ?FormParams &$formParams) {
        parent::__construct ($client , $formParams);

        $this->set_method (URLs::payment_inquiry);
    }

}
