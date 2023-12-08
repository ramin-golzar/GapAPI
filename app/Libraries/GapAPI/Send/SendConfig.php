<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\Params;

class SendConfig
{

    /**
     * Holds the token robot
     *
     * @var string
     */
    public string $token = null;

    /**
     * Holds the method for send message or data
     *
     * @var string
     */
    public string $method = null;

    /**
     * Contains parameters key to send
     *
     * @var Params
     */
    public Params $params = null;

    /**
     * Is it necessary to upload?
     *
     * @var bool
     */
    public bool $uploadRequire = false;

    /**
     * Holds the content type
     *
     * @var string
     */
    public string $contentType = null;

    /**
     * Holds a content type string
     *
     * It is suitable for sending anything except files
     */
    public const APPLICATION = 'application/x-www-form-urlencoded';

    /**
     * Holds a content type string
     *
     * It is suitable sending file
     */
    public const MULTIPART = 'multipart/form-data';

}
