<?php
namespace App\Libraries\GapAPI\Send\Handlers;

/**
 * This enum file to specify the currency
 */
enum Currency: string
{

    case rial = 'IRR';
    case dollar = 'USD';
    case gapcy = 'coin';

}
