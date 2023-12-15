<?php
namespace App\Libraries\GapAPI\Send\Handlers;

use App\Libraries\GapAPI\Handlers\Codes;

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

    private function json_encode (array &$params): void {
        foreach ($params as $key => &$keyboard) {
            if (in_array ($key , $this->forJSON)) {
                if (is_array ($keyboard)) {
                    $keyboard = json_encode (compact ('keyboard'));
                } elseif (is_string ($key)) {
                    echo '*** string ***';
                }
            }
        }
    }

}
