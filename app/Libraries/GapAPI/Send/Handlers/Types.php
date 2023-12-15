<?php
namespace App\Libraries\GapAPI\Send\Handlers;

enum Types
{

    case text;
    case image;
    case video;
    case audio;
    case voice;
    case file;

}
