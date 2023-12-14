<?php
namespace App\Controllers;

class Test extends BaseController
{

    public string $var;
    public array $var2;

    public function index (): void {
        $this->var2['aaa'] = 'aaaaa';

        var_dump ($this->var2);

        /* -------------------------------------------------------------------------------- */

        $chat_id = '12345';
        $type = ['a' => 'aaaaaa' ,];

        $params ['form_params'] = compact ('chat_id' , 'type');

        echo'<pre><b>';
        print_r ($params);
        echo'</b></pre>';
    }

}
