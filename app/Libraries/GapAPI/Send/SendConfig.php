<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\Handlers\URLs;

class SendConfig
{

    /**
     * Holds the headers properties
     *
     * @var Headers
     */
    protected array $headers = null;

    /**
     * Holds the method for send message or data
     *
     * @var string
     */
    protected string $method = null;

    /**
     * Contains parameters key to send
     *
     * @var Params
     */
    protected array $form_params = null;

    /**
     * To hold the upload parameters
     *
     * @var Multipart
     */
    protected array $multipart = null;

    /**
     * Is it necessary to upload?
     *
     * @var bool
     */
    protected bool $uploadRequire = false;

    /**
     * Setting the token in the header
     *
     * @param string $token
     * @return void
     */
    protected function set_token (string &$token): void {
        $this->headers ['token'] = $token;
    }

    /**
     * Holds a content type string
     *
     * It is suitable for sending anything except files
     */
    protected const APPLICATION = 'application/x-www-form-urlencoded';

    /**
     * Holds a content type string
     *
     * It is suitable sending file
     */
    protected const MULTIPART = 'multipart/form-data';

    /**
     * Setting a valid value for content-type header
     *
     * @param string $contentType
     * @return void
     */
    protected function set_content_type (string &$contentType): void {
        $this->headers ['Content-Type'] = $contentType;
    }

    protected function getting_base_options (): array {
        return [
            'headers' => [
                'token' => $this->headers ['token'] ,
            ] ,
            'baseURI' => URLs::BASE_URL ,
        ];
    }

    protected function getting_options (): array {
        $options = [
            'headers' => [
                'Content-Type' => $this->headers ['Content-Type'] ,
            ] ,
        ];

        if ($this->uploadRequire) {
            $options ['multipart'] = $this->
        }
    }

}
