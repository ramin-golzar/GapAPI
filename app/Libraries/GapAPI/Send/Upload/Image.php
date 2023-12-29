<?php
namespace App\Libraries\GapAPI\Send\Upload;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\URLs;
use App\Libraries\GapAPI\Send\Handlers\Types;

class Image extends BaseSend
{

    public function __construct (object &$client , ?FormParams &$formParams , ?Multipart &$multipart = null) {
        parent::__construct ($client , null , $multipart);

        $this->set_type (Types::image);

        $this->set_method (URLs::upload);
    }

}
