<?php
namespace App\Libraries\GapAPI\Receive;

class Receive
{

    private object $post;

    public function __construct (object $request) {
        $this->post = (object) $request->getPost ();
    }

    public function get_chat_id (): string|false {
        return $this->post->chat_id ?: false;
    }

    public function get_from (string $fromKey = ''): array|string|false {
        if (!$this->post->from) {
            return false;
        }

        $fromDecoded = json_decode ($this->post->from);

        return $fromKey ? $fromDecoded [$fromKey] : $fromDecoded;
    }

}
