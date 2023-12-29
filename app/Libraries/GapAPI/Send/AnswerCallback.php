<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Send\Handlers\URLs;

class AnswerCallback extends BaseSend
{

    public function __construct (object &$client , ?FormParams &$formParams) {
        parent::__construct ($client , $formParams);

        $this->set_method (URLs::answer_callback);
    }

}
