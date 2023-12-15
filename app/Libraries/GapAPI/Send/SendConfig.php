<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\Handlers\URLs;

class SendConfig
{

    public function __construct (string &$token) {
        $this->client = \Config\Services::curlrequest ($this->get_base_options ($token));
    }

    /**
     * This is cURL object
     *
     * @var object
     */
    private object $client;

    /**
     * Holds the method for send message or data
     *
     * @var string
     */
    protected string $method;

    /**
     * Contains parameters key to send
     *
     * @var Params
     */
    protected array $formParams;

    /**
     * To hold the upload parameters
     *
     * @var Multipart
     */
    protected array $multipart;

    /**
     * Is it necessary to upload?
     *
     * @var bool
     */
    protected bool $uploadRequire = false;

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

    /**
     * Return the base options for cURL
     *
     * @return array
     */
    private function get_base_options (string &$token): array {
        return [
            'headers' => [
                'token' => $token ,
            ] ,
            'baseURI' => URLs::BASE_URL ,
        ];
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
     * Sets the data type
     *
     * @param FormParams $params
     * @param Types $type
     * @return void
     */
    protected function set_type (FormParams &$params , Types $type): void {
        $params->type = $type->name;
    }

    /**
     * Sending evetything except upload file
     *
     * @return object
     */
    protected function request (): object {
        return $this->client->request ('POST' , $this->method , $this->get_options ());
    }

}
