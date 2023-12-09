<?php
namespace App\Libraries\GapAPI\Send\Handlers;

use App\Libraries\GapAPI\Handlers\Params;

class PrepareParams
{

    public function run (): array|null {
        $params = new Params();

        $result = [];

        foreach ($params as $k => $v) {
            if (!is_null ($v)) {
                $result [$k] = $v;
            }
        }

        return $result ?: null;
    }

}
