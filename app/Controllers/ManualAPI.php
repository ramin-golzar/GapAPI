<?php
namespace App\Controllers;

use App\Libraries\TestAPI\GetText;

class ManualAPI extends BaseController
{

    public function index (): void {
        $this->get_text ();
    }

    public function get_text (): void {
        $api = new GetText();

        $api->get ();
    }

    private function log (string $string): void {
        file_put_contents (WRITEPATH . 'TestAPI.txt' , "\n$string\n" , FILE_APPEND);
    }

}
