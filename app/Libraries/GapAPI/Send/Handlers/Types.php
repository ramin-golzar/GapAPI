<?php
namespace App\Libraries\GapAPI\Send\Handlers;

/**
 * This enum file to specify the data type
 * for sendMessage method
 */
enum Types
{

    case text;
    case image;
    case video;
    case audio;
    case voice;
    case file;
    case contact;
    case location;
    case typing;

}
