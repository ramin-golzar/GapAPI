<?php
namespace App\Libraries\GapAPI\Send\Handlers;

use App\Libraries\GapAPI\Send\Handlers\Headers;

class PrepareHeaders
{

    /**
     * Preparing the header properties
     *
     * @return array
     */
    public function run (): array {
        $headers = new Headers();

        $result = (array) $headers;

        foreach ($result as &$k => $v) {
            str_replace ('_' , '-' , $k);
        }

        return $result;
    }

}
