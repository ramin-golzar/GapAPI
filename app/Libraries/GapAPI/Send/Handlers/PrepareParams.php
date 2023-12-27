<?php
namespace App\Libraries\GapAPI\Send\Handlers;

use App\Libraries\GapAPI\Templates\ReplyKeyboard;
use App\Libraries\GapAPI\Templates\InlineKeyboard;
use App\Libraries\GapAPI\Templates\Form;

class PrepareParams
{

    /**
     * Start preparing the parameters
     *
     * @return array|null
     */
    public function run (object &$params): array {
        /* ToDo: set the chat id, if not set */

        $ignoreNullParams = $this->ignore_empty_params ($params);

        $this->json_encode ($ignoreNullParams);

        return $ignoreNullParams;
    }

    /**
     * Ignoring the empty parameters
     *
     * @param Params $params
     * @return array|null
     */
    private function ignore_empty_params (object &$params): array {
        $arrayParams = (array) $params;

        foreach ($arrayParams as $k => $v) {
            if (empty ($arrayParams [$k])) {
                unset ($arrayParams [$k]);
            }
        }

        return $arrayParams;
    }

    /**
     * JSON some properties
     *
     * @param array $params
     * @return void
     */
    private function json_encode (array &$params): void {
        $this->encode_reply_keyboard ($params)
            ->encode_inline_keyboard ($params)
            ->encode_form ($params);
    }

    /**
     * JSON encoding the reply keyboard
     *
     * @param array $params
     * @return object
     */
    private function encode_reply_keyboard (array &$params): object {
        if (!isset ($params['reply_keyboard'])) {
            return $this;
        } else {
            $replyKeyboard = $params ['reply_keyboard'];
        }

        if (is_array ($replyKeyboard)) {
            $replyKeyboard = ['keyboard' => $replyKeyboard];

            $params ['reply_keyboard'] = json_encode ($replyKeyboard);
        } elseif (is_string ($replyKeyboard)) {
            $keyboard = $this->get_template ('ReplyKeyboard' , $replyKeyboard);

            $params ['reply_keyboard'] = json_encode (compact ('keyboard'));
        }

        return $this;
    }

    /**
     * JSON encoding the inline keyboard
     *
     * @param array $params
     * @return object
     */
    private function encode_inline_keyboard (array &$params): object {
        if (!isset ($params['inline_keyboard']) && !isset ($params ['paymentKeyboard'])) {
            return $this;
        } elseif (!isset ($params['inline_keyboard']) && isset ($params ['paymentKeyboard'])) {
            $params ['inline_keyboard'] = [];
            $inlineKeyboard = $params ['inline_keyboard'];
        } else {
            $inlineKeyboard = $params ['inline_keyboard'];
        }

        if (is_array ($inlineKeyboard)) {
            $this->push_peyment_keyboard ($params , $inlineKeyboard);

            $params ['inline_keyboard'] = json_encode ($inlineKeyboard);
        } elseif (is_string ($inlineKeyboard)) {
            $inlineKeyboard = $this->get_template ('InlineKeyboard' , $inlineKeyboard);

            $this->push_peyment_keyboard ($params , $inlineKeyboard);

            $params ['inline_keyboard'] = json_encode ($inlineKeyboard);
        }

        return $this;
    }

    /**
     * Push the payment keybord in to the inline keyboard
     *
     * @param array $params
     * @param array $inlineKeyboard
     * @return void
     */
    private function push_peyment_keyboard (array &$params , array &$inlineKeyboard): void {
        if (isset ($params ['paymentKeyboard'])) {
            foreach ($params ['paymentKeyboard'] as $keyboard) {
                array_push ($inlineKeyboard , [$keyboard]);
            }
        }
    }

    /**
     * JSON encoding the form
     *
     * @param array $params
     * @return object
     */
    private function encode_form (array &$params): object {
        if (!isset ($params['form'])) {
            return $this;
        } else {
            $form = $params ['form'];
        }

        if (is_array ($form)) {
            $params ['form'] = json_encode ($form);
        } elseif (is_string ($form)) {
            $form = $this->get_template ('Form' , $form);
            $params ['form'] = json_encode ($form);
        }

        return $this;
    }

    /**
     * Return an array of template
     *
     * @param string $className <p>Allowed: ReplyKeyboard , InlineKeyboard , Form</p>
     * @param string $propertyName
     * @return array
     */
    private function get_template (string $className , string $propertyName): array {
        $temp = match ($className) {
            'ReplyKeyboard' => new ReplyKeyboard() ,
            'InlineKeyboard' => new InlineKeyboard() ,
            'Form' => new Form() ,
        };

        return $temp->$propertyName;
    }

}
