<?php
namespace App\Libraries\GapAPI\Handlers;

/**
 * This class contains parameters to
 * send data except upload
 *
 */
class FormParams
{

    /**
     * To holds user chat id
     *
     * @var string
     */
    public string $chat_id = '';

    /**
     * To hold the value of type param
     *
     * @var string
     */
    public string $type = '';

    /**
     * To holds value of data param
     *
     * @var string
     */
    public string $data = '';

    /**
     * To holds an array of reply_keyboard or
     * string name of reply keyboard template
     *
     *
     * @var string|array
     */
    public string|array $reply_keyboard = '';

    /**
     * To holds the contact & location
     * reply keyboard
     *
     * @var array
     */
    public array $info_keyboard = [];

    /**
     * To holds array of inline keyboard or
     * string name of it template
     *
     * @var string|array
     */
    public string|array $inline_keyboard = '';

    /**
     * To holds array of inline keyboard for
     * payments
     *
     * @var array
     */
    public array $paymentKeyboard = [];

    /**
     * To holds an array of form or string
     * name of it template
     *
     * @var string|array
     */
    public string|array $form = '';

    /**
     * To holds value of text param
     *
     * @var string
     */
    public string $text = '';

    /**
     * To holds value of callback_id param
     *
     * @var string
     */
    public string $callback_id = '';

    /**
     * To holds value for show_alert param
     *
     * @var bool
     */
    public bool $show_alert = false;

    /**
     * To holds value of amount param
     *
     * @var string
     */
    public string $amount = '';

    /**
     * To holds value of currency param
     *
     * @var string
     */
    public string $currency = '';

    /**
     * To holds value of description param
     *
     * @var string
     */
    public string $description = '';

    /**
     * To holds value of expire_time param
     *
     * @var string
     */
    public string $expir_time = '';

    /**
     * To holds value of ref_id param
     *
     * @var string
     */
    public string $ref_id = '';

    /**
     * To holds value of message_id param
     *
     * @var string
     */
    public string $message_id = '';

}
