<?php
namespace App\Libraries\GapAPI\Send\Handlers;

use App\Libraries\GapAPI\Handlers\Codes;

class PrepareParams
{

    /**
     * Start preparing the parameters
     *
     * @return array|null
     */
    public function run (object &$params): array {
        $this->set_chat_id ($params);

        $ignoreNullParams = $this->ignoring_null_params ($params);

        return $ignoreNullParams;
    }

    /**
     * Ignoring the null parameters
     *
     * @param Params $params
     * @return array|null
     */
    private function ignoring_null_params (object &$params): array {
        $result = [];

        foreach ($params as $k => $v) {
            if ($v) {
                $result [$k] = $v;
            }
        }

        return $result;
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

}
