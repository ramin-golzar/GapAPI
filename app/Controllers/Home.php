<?php
namespace App\Controllers;

class Home extends BaseController
{

    public function index () {
        $post = $this->request->getPost ();

        $gapApi = new \App\Libraries\GapAPI\GapAPI();

//        if ($post ['type'] == 'join') {
        $gapApi->send ($post ['chat_id']);
//        }
    }

}
