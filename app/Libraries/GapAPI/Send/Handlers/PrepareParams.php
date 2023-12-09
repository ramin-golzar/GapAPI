<?php
namespace App\Libraries\GapAPI\Send\Handlers;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Codes;

class PrepareParams
{

    /**
     * Start preparing the parameters
     *
     * @return array|null
     */
    public function run (): array|null {
        $params = new FormParams();

        $this->set_chat_id ($params);

        $result = $this->ignoring_null_params ($params);

        return $result;
    }

    /**
     * Ignoring the null parameters
     *
     * @param Params $params
     * @return array|null
     */
    private function ignoring_null_params (FormParams &$params): array|null {
        $result = [];

        foreach ($params as $k => $v) {
            if (!is_null ($v)) {
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
    private function set_chat_id (FormParams &$params): string|null {
        $codes = new Codes();

        return $params->chat_id ?? $codes->get_chat_id ();
    }

}
