<?php
namespace App\Libraries\GapAPI\Receive;

enum Types
{

    case join;
    case leave;
    case text;
    case image;
    case video;
    case audio;
    case voice;
    case file;
    case contact;
    case location;
    case form;
    case triggerButton;
    case paycallback;
    case invoicecallback;

}
