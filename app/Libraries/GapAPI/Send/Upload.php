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

    /**
     * Holds the desc parameter
     *
     * @var string
     */
    private string $description = '';

    public function __construct (Types $type , object &$client , ?FormParams &$formParams = null , ?Multipart &$multipart = null) {
        $this->detach_description ($multipart);

        parent::__construct ($client , $formParams , $multipart);

        $this->set_type ($type);

        $this->type = $type;

        $this->set_method (URLs::upload);

        $this->set_upload_required (true);
    }

    /**
     * Detach the desc parameter
     *
     * @param Multipart|null $multipart
     * @return void
     */
    private function detach_description (?Multipart &$multipart): void {
        if (!is_null ($multipart)) {
            $this->description = $multipart->desc;

            $multipart->desc = '';
        }
    }

    public function request (): object {
        $uploadRequest = parent::request ();

        if ($uploadRequest->getStatusCode () == 200) {
            return $this->send_file ($uploadRequest);
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
    private function send_file (object &$uploadRequest): object {
        $this->set_method (URLs::send_message);

        $this->set_type ($this->type);

        $this->set_upload_required (false);

        $this->set_description ($uploadRequest);

        return parent::request ();
    }

    /**
     * Setting the description parameter in
     * the formParams
     *
     * @param object $uploadRequest
     * @return void
     */
    private function set_description (object &$uploadRequest): void {
        if ($this->description) {
            $decoded = json_decode ($uploadRequest->getBody () , true);

            $decoded['desc'] = $this->description;

            $this->formParams ['data'] = json_encode ($decoded);
        } else {
            $this->formParams ['data'] = $uploadRequest->getBody ();
        }
    }

}
