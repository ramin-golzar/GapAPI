<?php
namespace App\Libraries\GapAPI;

class SendParams
{

    public string $chatId = null;
    public string $type = null;
    public string $data = null;
    public string|array $replyKeyboard = null;
    public string|array $inlineKeyboard = null;
    public string $form = null;

}
