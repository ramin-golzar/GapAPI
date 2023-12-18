<?php
namespace App\Libraries\GapAPI\Send\Handlers;

/**
 * This class contains URLs for send
 */
enum URLs: string
{

    case base_url = 'https://api.gap.im/';
    case send_message = 'sendMessage';
    case upload = 'upload';
    case edit_message = 'editMessage';
    case send_action = 'sendAction';
    case delete_message = 'deleteMessage';
    case answer_callback = 'answerCallback';
    case payment_inquiry = 'payment/inquiry';
    case payment_verify = 'payment/verify';
    case invoice_inquiry = 'invoice/inquiry';
    case invoice_verify = 'invoice/verify';
    case invoice = 'invoice';

}
