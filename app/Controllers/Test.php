<?php
namespace App\Controllers;

class Test extends BaseController
{

    public function index (): void {
        $chat_id = '12345';
        $type = 'file';

        $params ['form_params'] = compact ('chat_id' , 'type');

        echo'<pre><b>';
        print_r ($params);
        echo'</b></pre>';
    }

}
