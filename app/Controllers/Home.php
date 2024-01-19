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
                ['text' => 'Audio' , 'cb_data' => 'audio']
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

        $this->process_text ();

        $this->process_inline_keyboard ();

        $this->process_form ();
    }

    private function process_text (): void {
        $text = $this->gap->get_text ();

        if (!$text) {
            return;
        }

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
                break;
            case 'menu':
            default:
                $this->gap->set_reply_keyboard ($this->keyboards['main'])
                    ->send_text ('Please select one of buttons below');
        }
    }

    private function process_inline_keyboard (): void {
        $keyboard = $this->gap->get_trigger_button (true , 'data');

        if (!$keyboard) {
            return;
        }

        $this->send_file ($keyboard);
    }

    private function send_file (string $keyboard): void {
        switch ($keyboard) {
            case 'image':
                $this->gap->set_reply_keyboard ($this->keyboards['menu'])
                    ->send_image (FCPATH . "/Files/image.jpg");
                break;
            case 'video':
                $this->gap->set_reply_keyboard ($this->keyboards['menu'])
                    ->send_video (FCPATH . "/Files/video.mp4");
                break;
            case 'audio':
                $this->gap->set_reply_keyboard ($this->keyboards['menu'])
                    ->send_audio (FCPATH . "/Files/audio.mp3");
                break;
            case 'voice':
                $this->gap->set_reply_keyboard ($this->keyboards['menu'])
                    ->send_audio (FCPATH . "/Files/voice.ogg");
                break;
            case 'file':
                $this->gap->set_reply_keyboard ($this->keyboards['menu'])
                    ->send_file (FCPATH . "/Files/image.jpg");
                break;
        }
    }

    private function process_form (): void {
        $form = $this->gap->get_form (true , 'data');

        if (!$form) {
            return;
        }

        $data = explode ('&' , $form);
        foreach ($data as &$value) {
            $value = explode ('=' , $value);
        }

        $text = 'Your first name is '
            . esc ($data[0][1])
            . ', and your last name is '
            . esc ($data [1][1])
            . ' 😉';

        $this->gap->set_reply_keyboard ($this->keyboards['menu'])
            ->send_text ($text);
    }

}
