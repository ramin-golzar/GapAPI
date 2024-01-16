<?php
namespace App\Libraries\GapAPI;

class GapAPI extends SetParams
{

    use Receive\Receive;

    use Send\Send;

    public function __construct (string &$token , object &$request) {
        $this->post = (object) $request->getPost ();

        parent::__construct ();

        $this->client = \Config\Services::curlrequest ($this->get_base_options ($token));
    }

    /**
     * To send request by CURL
     *
     * @param object $sendClass
     * @param bool $resetParams
     * @return object
     */
    protected function request (object &$sendClass , bool $resetParams = true): object {
        $response = $sendClass->request ();

        if ($resetParams) {
            $this->init_params ();
        }

        return $response;
    }

}
