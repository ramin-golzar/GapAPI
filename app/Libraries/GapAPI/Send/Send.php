<?php
namespace App\Libraries\GapAPI\Send;

use App\Libraries\GapAPI\Send\SendConfig;
use App\Libraries\GapAPI\Send\Handlers\URLs;
use App\Libraries\GapAPI\Send\Handlers\PrepareParams;
use App\Libraries\GapAPI\Handlers\FormParams;

enum Types
{

    case text;
    case image;
    case video;
    case audio;
    case voice;
    case file;

}

class Send extends SendConfig
{

    public function __construct (string &$token) {
        parent::__construct ($token);
    }

    private function set_type (FormParams &$params , Types $type): void {
        echo'<pre><b>';
        var_dump ($type);
        echo'</b></pre>';
        $params->type = $type;
    }

    public function send_text (object $formParams): object {
        $this->method = URLs::SEND_MESSAGE;

        $this->set_type ($formParams , Types::text);
//        $formParams->type = 'text';

        $prepareParams = new PrepareParams();

        $this->formParams = $prepareParams->run ($formParams);

        return $this->request ();
    }

}
