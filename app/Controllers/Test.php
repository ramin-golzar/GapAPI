<?php
namespace App\Controllers;

class Test extends BaseController
{

    public function index (): void {
        $Super = [
            [
                ['start' => 'Start' ,] ,
                ['rank' => 'Rank'] ,
            ]
        ];

        $select = 'AAAAA';

        echo'<pre><b>';
        print_r ($Super);
        echo'</b></pre>';

        echo '<hr />';

        $result = compact ("Super" , 'select');

        echo'<pre><b>';
        print_r ($result);
        echo'</b></pre>';
    }

}
