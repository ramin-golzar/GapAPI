<?php
namespace App\Controllers;

class Home extends BaseController
{

    /**
     * To holds token of bot
     *
     * @var string
     */
    private string $token = '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496';

    /**
     * To holds the user chat id
     *
     * @var string
     */
    private string $chatId = '339322905';

    /**
     * Gap API
     *
     * @var object
     */
    private object $gap;

    /**
     * To holds keyboards
     *
     * @var array
     */
    private array $keyboards = [
        'main' => [[['list' => 'list']] , [['register' => 'register']]] ,
        'menu' => [[['menu' => 'menu' ,]]] ,
        'list' => [
            [
                ['text' => 'image' , 'cb_data' => 'image']
            ] ,
            [
                ['text' => 'video' , 'cb_data' => 'video']
            ] ,
            [
                ['text' => 'Audio' , 'cb_data' => 'Audio']
            ] ,
            [
                ['text' => 'voice' , 'cb_data' => 'voice']
            ] ,
            [
                ['text' => 'file' , 'cb_data' => 'file']
            ]
        ] ,
        'register' => [
            [
                'type' => 'text' ,
                'name' => 'first_name' ,
                'label' => 'first name:' ,
            ] ,
            [
                'type' => 'text' ,
                'name' => 'last_name' ,
                'label' => 'last name:' ,
            ]
        ] ,
    ];

    public function index () {
        $this->gap = new \App\Libraries\GapAPI\GapAPI ($this->token , $this->request);

        $this->process_input ();
    }

    private function process_input (): void {
        $text = $this->gap->get_text ();

        switch ($text) {
            case 'list':
                $this->gap->set_inline_keyboard ($this->keyboards['list'])
                    ->set_reply_keyboard ($this->keyboards ['menu'])
                    ->send_text ('Please select one glass keyboard');
                break;
            case 'register':
                $this->gap->set_form ($this->keyboards['register'])
                    ->set_reply_keyboard ($this->keyboards['menu'])
                    ->send_text ('Please fill this form');
            case 'menu':
            default :
                $this->gap->set_reply_keyboard ($this->keyboards['main'])
                    ->send_text ('Please select one of buttons below');
        }
    }

}
