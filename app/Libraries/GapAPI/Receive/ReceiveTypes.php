<?php
namespace App\Libraries\GapAPI\Receive;

/**
 * This enum file contains data type
 * for get from user
 */
enum ReceiveTypes
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
    case submitForm;
    case triggerButton;
    case paycallback;
    case invoicecallback;

}
