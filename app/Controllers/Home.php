<?php
namespace App\Controllers;

class Home extends BaseController
{

    public function index () {
        /* ----------------------------------------------------------------------
         * init GapAPI
         * ----------------------------------------------------------------------
         */

        $token = '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496';

        $chatId = '339322905';

        $gap = new \App\Libraries\GapAPI\GapAPI ($token , $this->request);
    }

}
