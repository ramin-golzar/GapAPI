<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\Handlers\URLs;

class SendConfig
{

    /**
     * Holds the token
     *
     * @var Headers
     */
    protected string $token = null;

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
     * Holds a content type string
     *
     * It is suitable for sending anything except files
     */
    protected const CONTENT_TYPE_APPLICATION = 'application/x-www-form-urlencoded';

    /**
     * Holds a content type string
     *
     * It is suitable sending file
     */
    protected const CONTENT_TYPE_MULTIPART = 'multipart/form-data';

    /**
     * Return the base options for cURL
     *
     * @return array
     */
    protected function get_base_options (): array {
        return [
            'headers' => [
                'token' => $this->token ,
            ] ,
            'baseURI' => URLs::BASE_URL ,
        ];
    }

    /**
     * Getting array of options
     *
     * @return array
     */
    protected function get_options (): array {
        if ($this->uploadRequire) {
            return $this->get_upload_options ();
        } else {
            return $this->get_send_options ();
        }
    }

    /**
     * Getting options for everything except uploading
     *
     * @return array
     */
    private function get_send_options (): array {
        return [
            'headers' => [
                'Content-Type' => self::CONTENT_TYPE_APPLICATION ,
            ] ,
            compact ($this->form_params) ,
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
            compact ($this->multipart) ,
        ];
    }

}
