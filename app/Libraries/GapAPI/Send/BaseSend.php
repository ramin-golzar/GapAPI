<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\Types;
use App\Libraries\GapAPI\Send\Handlers\URLs;
use App\Libraries\GapAPI\Send\Handlers\PrepareParams;

class BaseSend
{

    /**
     * Holds the method for send message or data
     *
     * @var string
     */
    private string $method;

    /**
     * Contains parameters key to send
     *
     * @var Params
     */
    private ?array $formParams = [];

    /**
     * To hold the upload parameters
     *
     * @var Multipart
     */
    private ?array $multipart = [];

    /**
     * This is cURL request object
     *
     * @var object
     */
    public object $client;

    /**
     * Holds a content type string
     *
     * It is suitable for sending anything except files
     */
    private const CONTENT_TYPE_APPLICATION = 'application/x-www-form-urlencoded';

    /**
     * Holds a content type string
     *
     * It is suitable sending file
     */
    private const CONTENT_TYPE_MULTIPART = 'multipart/form-data';

    public function __construct (object &$client , ?FormParams &$formParams , ?Multipart &$multipart = null) {
        $this->prepare_params ($formParams , $multipart);

        $this->client = $client;
    }

    /**
     * Sets the valid method on end of URL
     *
     * @param URLs $method
     * @return void
     */
    protected function set_method (URLs $method): void {
        $this->method = $method->value;
    }

    /**
     * Sets the data type
     *
     * @param Types $type
     * @return void
     */
    protected function set_type (Types $type): void {
        $this->formParams ['type'] = $type->name;
    }

    /**
     * Initialize the formParams & multipar
     * properties for send
     *
     * @param object $formParams
     * @param object|null $multipart
     * @return void
     */
    protected function prepare_params (object &$formParams , ?object &$multipart = null): void {
        $prepareParams = new PrepareParams();

        if ($formParams) {
            $this->formParams = $prepareParams->run ($formParams);
        }

        if ($multipart) {
            $this->multipart = $prepareParams->run ($multipart);
        }
    }

    /**
     * Getting array of options
     *
     * @return array
     */
    private function get_options (): array {
        if ($this->multipart) {
            return $this->get_upload_options ();
        } else {
            return $this->get_message_options ();
        }
    }

    /**
     * Getting options for everything except uploading
     *
     * @return array
     */
    private function get_message_options (): array {
        return [
            'headers' => [
                'Content-Type' => self::CONTENT_TYPE_APPLICATION ,
            ] ,
            'form_params' => $this->formParams ,
        ];
    }

    /**
     * Getting options for uploading
     *
     * @return array
     */
    private function get_upload_options (): array {
        return [
            'headers' => [
                'Content-Type' => self::CONTENT_TYPE_MULTIPART ,
            ] ,
            'multipart' => $this->multipart ,
        ];
    }

    /**
     * Sending evetything except upload file
     *
     * @return object
     */
    public function request (): object {
        return $this->client->request ('POST' , $this->method , $this->get_options ());
    }

}
