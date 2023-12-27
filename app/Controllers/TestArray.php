<?php
namespace App\Controllers;

class TestArray extends BaseController
{

    public function index (): void {
        $a1 = ['key' => 'value' ,];

        $a2 = ['k2' => [
                'k3' => 'v3' ,
            ] ,
        ];

        $a3 = array_merge ($a1 , $a2);

        echo'<pre><b>';
        print_r ($a3);
        echo'</b></pre>';
    }

}
