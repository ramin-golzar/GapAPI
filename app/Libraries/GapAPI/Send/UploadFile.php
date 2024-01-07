<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\URLs;
use App\Libraries\GapAPI\Send\Handlers\Types;

class UploadFile extends BaseSend
{

    /**
     * Specifies what type of file to upload
     *
     * @var Types
     */
    private Types $type;

    public function __construct (Types $type , object &$client , ?FormParams &$formParams = null , ?Multipart &$multipart = null) {
        parent::__construct ($client , $formParams , $multipart);

        $this->set_type ($type);

        $this->type = $type;

        $this->set_method (URLs::upload);

        $this->set_upload_required (true);
    }

    public function request (): object {
        $uploadRequest = parent::request ();

        return $uploadRequest;
    }

}
