<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Handlers\Params;

class SendConfig
{

    public string $token = null;
    public string $method = null;
    public Params $params = null;
    public bool $uploadRequire = false;

}
