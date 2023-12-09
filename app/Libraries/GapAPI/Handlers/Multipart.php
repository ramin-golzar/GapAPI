<?php
namespace App\Libraries\GapAPI\Handlers;

class Multipart
{

    /**
     * Holds the chatId params
     *
     * @var string
     */
    public string $chat_id = null;

    /**
     * This is CurlFile object for send image
     *
     * @var object
     */
    public object $image = null;

    /**
     * This is CurlFile object for send video
     *
     * @var object
     */
    public object $video = null;

    /**
     * This is CurlFile object for send audio
     *
     * @var object
     */
    public object $audio = null;

    /**
     * This is CurlFile object for send voice
     *
     * @var object
     */
    public object $voice = null;

    /**
     * This is CurlFile object for send file
     *
     * @var object
     */
    public object $file = null;

    /**
     * Holds a description for a file
     *
     * @var string
     */
    public string $desc = null;

}
