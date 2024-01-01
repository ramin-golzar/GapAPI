<?php
namespace App\Libraries\GapAPI\Receive;

class BaseReceive
{

    private object $post;

    public function __construct (object $request) {
        $this->post = (object) $request->getPost ();
    }

    private function check_type (): string|false {
        return $this->post->type ?: false;
    }

    private function get_data (bool $decoding = false): string|array|false {
        if (!isset ($this->post->data)) {
            return false;
        } elseif (isset ($this->post->data) && !$decoding) {
            return $this->post->data;
        } elseif (isset ($this->post->data) && $decoding) {
            return json_decode ($this->post->data , true);
        }
    }

    protected function get (): string|false {
        if ($this->check_type () === 'text') {
            return $this->get_data ();
        }
    }

}
