<?php
namespace App\Libraries\GapAPI\Handlers;

class FormParams
{

    public string $chat_id = '';
    public string $type = 'text';
    public string $data = '';
    public string|array $reply_keyboard = '';
    public string|array $inline_keyboard = '';
    public string|array $form = '';

}
