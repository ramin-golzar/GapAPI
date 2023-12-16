<?php
namespace App\Libraries\GapAPI\Send\Handlers;

use App\Libraries\GapAPI\Handlers\Codes;
use App\Libraries\GapAPI\Templates\ReplyKeyboard;
use App\Libraries\GapAPI\Templates\InlineKeyboard;
use App\Libraries\GapAPI\Templates\Form;

class PrepareParams
{

    /**
     * Holds the properties to be JSON
     *
     * @var array
     */
    private array $forJSON = [
        'reply_keyboard' ,
        'inline_keyboard' ,
        'form' ,
    ];

    /**
     * Start preparing the parameters
     *
     * @return array|null
     */
    public function run (object &$params): array {
        $this->set_chat_id ($params);

        $ignoreNullParams = $this->ignoring_null_params ($params);

        $this->json_encode ($ignoreNullParams);

        return $ignoreNullParams;
    }

    /**
     * Ignoring the null parameters
     *
     * @param Params $params
     * @return array|null
     */
    private function ignoring_null_params (object &$params): array {
        $arrayParams = (array) $params;

        foreach ($arrayParams as $k => $v) {
            if (empty ($arrayParams [$k])) {
                unset ($arrayParams [$k]);
            }
        }

        return $arrayParams;
    }

    /**
     * Setting a value for chat_id parameter
     *
     * @param Params $params
     * @return string|null
     */
    private function set_chat_id (object &$params): void {
        $codes = new Codes();

        $params->chat_id = $params->chat_id ?? $codes->get_chat_id ();
    }

    /**
     * JSON some properties
     *
     * @param array $params
     * @return void
     */
    private function json_encode (array &$params): void {
        foreach ($params as $param => &$value) {
            if (in_array ($param , $this->forJSON)) {
                $this->json_method ($param , $value);
            }
        }
    }

    /**
     * Deciding on the JSON method
     *
     * @param string $param
     * @param array|string $paramValue
     * @return void
     */
    private function json_method (string &$param , array|string &$paramValue): void {
        if (is_array ($paramValue)) {
            $paramValue = json_encode ($this->compact ($param , $paramValue));
        } elseif (is_string ($paramValue)) {
            $paramValue = $this->get_template ($param , $paramValue);
            $paramValue = json_encode ($this->compact ($param , $paramValue));
        }
    }

    /**
     * Only compacting the reply_keyboard param
     *
     * @param string $param
     * @param array $keyboard
     * @return array
     */
    private function compact (string $param , array $keyboard): array {
        return ($param === 'reply_keyboard') ? compact ('keyboard') : $keyboard;
    }

    /**
     * Return an array of template
     *
     * @param string $className
     * @param string $propertyName
     * @return array
     */
    private function get_template (string $className , string $propertyName): array {
        $temp = match ($className) {
            'reply_keyboard' => new ReplyKeyboard() ,
            'inline_keyboard' => new InlineKeyboard() ,
            'form' => new Form() ,
        };

        return $temp->$propertyName;
    }

}
