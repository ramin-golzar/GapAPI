<?php
namespace App\Libraries\GapAPI;

class GapAPI extends SetParams
{

    use Receive\Receive;

    use Send\Send;

    public function __construct (string &$token , object &$request) {
        parent::__construct ();

        $this->client = \Config\Services::curlrequest ($this->get_base_options ($token));

        $this->post = (object) $request->getPost ();

        $this->set_chat_id ();
    }

}
