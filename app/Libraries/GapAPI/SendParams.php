<?php
namespace App\Libraries\GapAPI;

class SendParams
{

    /**
     * Holds the user chat id
     *
     * @var string
     */
    public string $chatId = null;

    /**
     * Holds the data type
     *
     * @var string
     */
    public string $type = null;

    /**
     * Holds the date for send to gap server
     *
     * @var string
     */
    public string $data = null;

    /**
     * Holds the json of reply keyboard
     *
     * @var string|array
     */
    public string|array $replyKeyboard = null;

    /**
     * Holds the json of inline keyboard
     *
     * @var string|array
     */
    public string|array $inlineKeyboard = null;

    /**
     * Holds the form data
     *
     * @var string
     */
    public string $form = null;

}
