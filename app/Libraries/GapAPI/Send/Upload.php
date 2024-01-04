<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\URLs;
use App\Libraries\GapAPI\Send\Handlers\Types;

class Upload extends BaseSend
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

        if ($uploadRequest->getStatusCode () == 200) {
            $this->send_file ($uploadRequest);
        } else {
            return $uploadRequest;
        }
    }

    /**
     * Sending the upload resutl to sendMessage URL
     *
     * @param object $uploadRequest
     * @return object
     */
    private function send_file (object $uploadRequest): object {
        $this->set_method (URLs::send_message);

        $this->set_type ($this->type);

        $this->formParams ['data'] = $uploadRequest->getBody ();

        $this->set_upload_required (false);

        return parent::request ();
    }

}
