<?php
namespace App\Libraries\GapAPI\Receive;

class Receive
{

    private object $post;

    public function __construct (object &$request) {
        $this->post = (object) $request->getPost ();
    }

    public function is_joined (): bool {
        return $this->check_type (Types::join);
    }

    public function is_leaved (): bool {
        return $this->check_type (Types::leave);
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

    public function get_data (Types $type , bool $decoding = false , string $dataKey = ''): string|array|false {
        if ($this->check_type ($type)) {
            return $this->data_analysis ($decoding , $dataKey);
        }

        return false;
    }

    private function check_type (Types $type): string|false {
        if (isset ($this->post->type) && $this->post->type == $type->name) {
            return true;
        }

        return false;
    }

    private function data_analysis (bool &$decoding = false , string $dataKey = ''): string|array|false {
        if (!isset ($this->post->data)) {
            return false;
        } elseif (isset ($this->post->data) && !$decoding) {
            return $this->post->data;
        } elseif (isset ($this->post->data) && $decoding) {
            $dataDecoded = json_decode ($this->post->data , true);

            return $dataKey ? $dataDecoded [$dataKey] : $dataDecoded;
        }
    }

}
