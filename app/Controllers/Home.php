<?php
namespace App\Controllers;

class Home extends BaseController
{

    private string $token = '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496';
    private string $chatId = '339322905';

    public function index () {
        $gap = new \App\Libraries\GapAPI\GapAPI ($this->token , $this->request);
    }

}
