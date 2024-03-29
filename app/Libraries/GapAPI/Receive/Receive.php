<?php
namespace App\Libraries\GapAPI\Receive;

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
     * To get the user chat id
     *
     * @return string|false
     */
    public function get_chat_id (): string|false {
        return $this->get_from_post ('chat_id');
    }

    /**
     * To get the from, the from contains user info
     *
     * @param string|null $fromKey
     * @param bool $decode
     * @return array|string|false
     */
    public function get_from (?string $fromKey = null , bool $decoding = true): array|string|false {
        return $this->get_from_post ('from' , $decoding , $fromKey);
    }

    /**
     * To get the text from user
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
     * To get the image contnt
     *
     * @param bool $decoding
     * @return string|array|false
     */
    public function get_image (bool $decoding = false): string|array|false {
        if ($this->exist_type (ReceiveTypes::image)) {
            return $this->get_from_post ('data' , $decoding);
        }

        return false;
    }

    /**
     * To get the video content
     *
     * @param bool $decoding
     * @return string|array|false
     */
    public function get_video (bool $decoding = false): string|array|false {
        if ($this->exist_type (ReceiveTypes::video)) {
            return $this->get_from_post ('data' , $decoding);
        }

        return false;
    }

    /**
     * To get the audio content
     *
     * @param bool $decoding
     * @return string|array|false
     */
    public function get_audio (bool $decoding = false): string|array|false {
        if ($this->exist_type (ReceiveTypes::audio)) {
            return $this->get_from_post ('data' , $decoding);
        }

        return false;
    }

    /**
     * To get the voice content
     *
     * @param bool $decoding
     * @return string|array|false
     */
    public function get_voice (bool $decoding = false): string|array|false {
        if ($this->exist_type (ReceiveTypes::voice)) {
            return $this->get_from_post ('data' , $decoding);
        }

        return false;
    }

    /**
     * To get a actulal file
     *
     * @param bool $decoding
     * @return string|array|false
     */
    public function get_file (bool $decoding = false): string|array|false {
        if ($this->exist_type (ReceiveTypes::file)) {
            return $this->get_from_post ('data' , $decoding);
        }

        return false;
    }

    /**
     * To get the contact info
     *
     * @param bool $decoding
     * @param string|null $returnKey
     * @return string|array|false
     */
    public function get_contact (bool $decoding = true , ?string $returnKey = null): string|array|false {
        if ($this->exist_type (ReceiveTypes::contact)) {
            return $this->get_from_post ('data' , $decoding , $returnKey);
        }

        return false;
    }

    /**
     * To get the user location
     *
     * @param bool $decoding
     * @param string|null $returnKey
     * @return string|array|false
     */
    public function get_location (bool $decoding = true , ?string $returnKey = null): string|array|false {
        if ($this->exist_type (ReceiveTypes::location)) {
            return $this->get_from_post ('data' , $decoding , $returnKey);
        }

        return false;
    }

    /**
     * To get the form data
     *
     * @param bool $decoding
     * @param string|null $returnKey
     * @return string|array|false
     */
    public function get_form (bool $decoding = true , ?string $returnKey = null): string|array|false {
        if ($this->exist_type (ReceiveTypes::submitForm)) {
            return $this->get_from_post ('data' , $decoding , $returnKey);
        }

        return false;
    }

    /**
     * To get info about inline button
     * was clicked
     *
     * @param bool $decodeing
     * @param string|null $returnKey
     * @return string|array|false
     */
    public function get_trigger_button (bool $decodeing = false , ?string $returnKey = null): string|array|false {
        if ($this->exist_type (ReceiveTypes::triggerButton)) {
            return $this->get_from_post ('data' , $decodeing , $returnKey);
        }

        return false;
    }

    /**
     * To get the paycallback info
     *
     * @param bool $decoding
     * @param string|null $returnKey
     * @return string|array|false
     */
    public function get_paycallback (bool $decoding = true , ?string $returnKey = null): string|array|false {
        log_message ('alert' , 'get_paycallback func');
        if ($this->exist_type (ReceiveTypes::paycallback)) {
            log_message ('alert' , 'get paycallback cond');
            return $this->get_from_post ('data' , $decoding , $returnKey);
        }

        return false;
    }

    /**
     * To get the invoice callback info
     *
     * @param bool $decoding
     * @param string|null $returnKey
     * @return string|array|false
     */
    public function get_invoicecallback (bool $decoding = true , ?string $returnKey = null): string|array|false {
        if ($this->exist_type (ReceiveTypes::invoicecallback)) {
            return $this->get_from_post ('data' , $decoding , $returnKey);
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

            return $postKeyKey ? esc ($decoded [$postKeyKey]) : esc ($decoded);
        }
    }

}
