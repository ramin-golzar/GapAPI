<?php
namespace App\Libraries\GapAPI\Handlers;

class FormParams
{

    public string $chat_id = '';
    public string $type = '';
    public string $data = '';
    public string|array $reply_keyboard = '';
    public string|array $inline_keyboard = '';
    public string|array $form = '';
    public string $text = '';
    public string $callback_id = '';
    public bool $show_alert = false;
    public string $amount = '';
    public string $currency = '';
    public string $description = '';
    public string $expir_time = '';

}
