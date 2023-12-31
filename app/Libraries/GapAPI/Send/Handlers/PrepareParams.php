<?php
namespace App\Libraries\GapAPI\Send\Handlers;

use App\Libraries\GapAPI\Templates\ReplyKeyboard;
use App\Libraries\GapAPI\Templates\InlineKeyboard;
use App\Libraries\GapAPI\Templates\Form;

class PrepareParams
{

    /**
     * Is it necessary to JSON
     *
     * @var bool
     */
    private bool $JSONRequired = true;

    /**
     * Start preparing the parameters
     *
     * @return array|null
     */
    public function run (object &$params): array {
        /* ToDo: set the chat id, if not set */

        $this->json_required ($params);

        $ignoreNullParams = $this->ignore_empty_params ($params);

        $this->json_encode ($ignoreNullParams);

        return $ignoreNullParams;
    }

    /**
     * Setting the $JSONRequired property
     *
     * @param object $params
     * @return void
     */
    private function json_required (object &$params): void {
        $this->JSONRequired = match (basename (get_class ($params))) {
            'FormParams' => true ,
            'Multipart' => false ,
        };
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
        if ($this->JSONRequired) {
            $this->encode_reply_keyboard ($params)
                ->encode_inline_keyboard ($params)
                ->encode_form ($params);
        }
    }

    /**
     * JSON encoding the reply keyboard
     *
     * @param array $params
     * @return object
     */
    private function encode_reply_keyboard (array &$params): object {
        if (!$this->exit_endoding_reply_keyboard ($params)) {
            return $this;
        }

        $infoKeyboard = $this->get_info_keyboard ($params);

        $replyKeyboard = $this->get_reply_keyboard ($params);

        $this->completion_reply_keyboard ($params , $replyKeyboard , $infoKeyboard);

        return $this;
    }

    /**
     * Exit condition from function encode_reply_keyboard
     *
     * @param array $params
     * @return bool
     */
    private function exit_endoding_reply_keyboard (array &$params): bool {
        if (!isset ($params ['reply_keyboard']) && !isset ($params ['info_keyboard'])) {
            return false;
        }

        return true;
    }

    /**
     * returning info_keyboard value as an array
     *
     * @param array $params
     * @return array
     */
    private function get_info_keyboard (array &$params): array {
        return isset ($params ['info_keyboard']) ? $params ['info_keyboard'] : [];
    }

    /**
     * Returning reply_keyboard value as an array
     *
     * @param array $params
     * @return array
     */
    private function get_reply_keyboard (array &$params): array {
        if (!isset ($params ['reply_keyboard'])) {
            return [];
        } else {
            if (is_array ($params ['reply_keyboard'])) {
                return $params ['reply_keyboard'];
            } elseif (is_string ($params ['reply_keyboard'])) {
                return $this->get_template ('ReplyKeyboard' , $params ['reply_keyboard']);
            }
        }
    }

    /**
     * Merge the reply_keyboard & info_keyboard,
     * and JSON them
     *
     * @param array $params
     * @param array $replyKeyboard
     * @param array $infoKeyboard
     * @return void
     */
    private function completion_reply_keyboard (array &$params , array &$replyKeyboard , array &$infoKeyboard): void {
        $keyboard ['keyboard'] = array_merge ($replyKeyboard , $infoKeyboard);

        if (!empty ($keyboard)) {
            $params ['reply_keyboard'] = json_encode ($keyboard);
        }

        unset ($params ['info_keyboard']);
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
