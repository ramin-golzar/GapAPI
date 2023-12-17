<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\Types;
use App\Libraries\GapAPI\Send\Handlers\URLs;

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
    private array $formParams;

    /**
     * To hold the upload parameters
     *
     * @var Multipart
     */
    private array $multipart;

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

    public function __construct (object &$client , ?FormParams $formParams , ?Multipart $multipart = null) {
        $this->formParams = $formParams;

        $this->multipart = $multipart;

        return $this->run ($client);
    }

    /**
     * Sets the valid method on end of URL
     *
     * @param URLs $method
     * @return void
     */
    protected function set_method (URLs $method): void {
        $this->method = $method;
    }

    /**
     * Sets the data type
     *
     * @param FormParams $params
     * @param Types $type
     * @return void
     */
    protected function set_type (Types &$type): void {
        $this->formParams->type = $type->name;
    }

    private function run (object &$client): object {
        $prepareParams = new PrepareParams();

        $this->formParams = $prepareParams->run ($this->formParams);

        return $this->request ($client);
    }

    /**
     * Getting array of options
     *
     * @return array
     */
    private function get_options (): array {
        if ($this->uploadRequire) {
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
    protected function request (object &$client): object {
        return $client->request ('POST' , $this->method , $this->get_options ());
    }

}
