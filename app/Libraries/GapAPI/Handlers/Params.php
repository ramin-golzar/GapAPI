<?php
namespace App\Libraries\GapAPI\Handlers;

class Params
{

    public string $chat_id = null;
    public string $type = null;
    public string|array $data = null;
    public string|array $reply_keyboard = null;
    public string|array $inline_keyboard = null;
    public string|array $form = null;

}
