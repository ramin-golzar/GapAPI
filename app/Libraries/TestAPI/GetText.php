<?php
namespace App\Libraries\TestAPI;

class GetText
{

    public function get (): string {
        $post = $this->request->getPost ();

        if ($post ['type'] == 'text') {
            return $post ['data'];
        } else {
            return 'Not Send Text';
        }
    }

}
