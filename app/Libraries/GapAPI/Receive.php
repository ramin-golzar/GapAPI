<?php
namespace App\Libraries\GapAPI;

trait Receive
{

    /**
     * Holds the data of post method
     *
     * @var object
     */
    private object $post;

    /**
     * If user is joined, returned true
     *
     * @return bool
     */
    public function is_joined (): bool {
        return $this->check_type (ReceiveTypes::join);
    }

    /**
     * If user is leaved, returned true
     *
     * @return bool
     */
    public function is_leaved (): bool {
        return $this->check_type (ReceiveTypes::leave);
    }

    /**
     * To get the chat_id
     *
     * @return string|false
     */
    public function get_chat_id (): string|false {
        return $this->post->chat_id ?: false;
    }

    /**
     * To get the from, from contains user info
     *
     * @param string|null $fromKey
     * @param bool $decode
     * @return array|string|false
     */
    public function get_from (?string $fromKey = null , bool $decoding = true): array|string|false {
        if (isset ($this->post->from)) {
            return $this->get_from_post ('from' , $decoding , $fromKey);
        }

        return false;
    }

    /**
     * To get the text content
     *
     * @return string|false
     */
    public function get_text (): string|false {
        if ($this->exist_type (ReceiveTypes::text)) {
            return $this->get_from_post ('data');
        }

        return false;
    }

    /**
     * To check exist a specific value of
     * type key into the post method
     *
     * @param ReceiveTypes $type
     * @return bool
     */
    private function exist_type (ReceiveTypes $type): bool {
        if (isset ($this->post->type) && $this->post->type == $type->name) {
            return true;
        }

        return false;
    }

    /**
     * To get a value of a specific key
     * from the post method
     *
     * @param string $postKey
     * @param bool $decoding
     * @param string|null $postKeyKey
     * @return string|array|false
     */
    private function get_from_post (string $postKey , bool &$decoding = false , ?string $postKeyKey = null): string|array|false {
        if (!isset ($this->post->$postKey)) {
            return false;
        } elseif (isset ($this->post->$postKey) && !$decoding) {
            return $this->post->$postKey;
        } elseif (isset ($this->post->$postKey) && $decoding) {
            $decoded = json_decode ($this->post->$postKey , true);

            return $postKeyKey ? $decoded [$postKeyKey] : $decoded;
        }
    }

}
