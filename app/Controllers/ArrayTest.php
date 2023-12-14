<?php
namespace App\Controllers;

class ArrayTest extends BaseController
{

    public function index (): void {
        $object = (object) [
                    'k1' => 'v1' ,
                    'k2' => 'v2' ,
                    'k3' => '' ,
        ];

        $result = $this->ignore ($object);

        echo'<pre><b>';
        print_r ($result);
        echo'</b></pre>';
    }

    public function ignore (object $params): array {
        $result = [];

        foreach ($params as $k => $v) {
            if ($v) {
                $result [$k] = $v;
            }
        }

        return $result;
    }

}
