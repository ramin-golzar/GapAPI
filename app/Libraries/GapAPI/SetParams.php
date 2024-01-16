<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\Currency;
use App\Libraries\GapAPI\Send\Handlers\Types;

class SetParams
{

    /**
     * To holds the form params
     *
     * This required to send messsage
     *
     * @var FormParams|null
     */
    protected ?FormParams $formParams;

    /**
     * To holds the multipart parameters
     *
     * This is required to upload
     *
     * @var Multipart|null
     */
    protected ?Multipart $multipart;

    public function __construct () {
        $this->init_params ();
    }

    /**
     * Setting the chat id in formParams
     * & multipart properties
     *
     * @param string|int $chatId <p>If not assigned, it will read from super global array $_POST</p>
     * @return object
     */
    public function set_chat_id (string|int $chatId = ''): object {
        if ($chatId) {
            $this->formParams->chat_id = $chatId;
            $this->multipart->chat_id = $chatId;
        } else {
            $this->formParams->chat_id = $this->get_chat_id ();
            $this->multipart->chat_id = $this->get_chat_id ();
        }

        return $this;
    }

    /**
     * Setting the data parameter
     *
     * @param string $data
     * @return void
     */
    protected function set_data (string $data): void {
        $this->formParams->data = $data;
    }

    /**
     * Setting the contact informations
     *
     * @param string $phone
     * @param string $name
     * @return void
     */
    protected function set_contact (string &$phone , string &$name): void {
        $data = [
            'phone' => $phone ,
            'name' => $name ,
        ];

        $this->formParams->data = json_encode ($data);
    }

    /**
     * Setting the location info
     *
     * @param string $lat
     * @param string $long
     * @param string $description
     * @return void
     */
    protected function set_location (string &$lat , string &$long , string &$description): void {
        $data = [
            'lat' => $lat ,
            'lang' => $long ,
            'desc' => $description ,
        ];

        $this->formParams->data = json_encode ($data);
    }

    /**
     * Setting the text parameter
     *
     * @param string $text
     * @return void
     */
    protected function set_text (string &$text): void {
        $this->formParams->text = $text;
    }

    /**
     * Setting the answer callback info
     *
     * @param string $text
     * @param string $callbackId
     * @param bool $showAlert
     * @return void
     */
    protected function set_answer_callback (string &$text , string &$callbackId , bool &$showAlert = false): void {
        $this->formParams->text = $text;

        $this->formParams->callback_id = $callbackId;

        $this->formParams->show_alert = $showAlert;
    }

    /**
     * Setting the invoice info
     *
     *
     * @param string $amount
     * @param string $description <p>this is displayed to user</p>
     * @param string $expirTime <p>this max value can be 604800 & min value can be 300</p>
     * @param Currency $currency
     * @return void
     */
    protected function set_invoice (string &$amount , string &$description , string &$expirTime = '300' , Currency $currency = Currency::rial): void {
        $this->formParams->amount = $amount;

        $this->formParams->currency = $currency->value;

        $this->formParams->description = $description;

        $this->formParams->expir_time = $expirTime;
    }

    /**
     * Setting the invoice inquiry info
     *
     * @param string $invoiceId
     * @return void
     */
    protected function set_invoice_inquiry (string $invoiceId): void {
        $this->formParams->ref_id = $invoiceId;
    }

    /**
     * Setting payment verify info
     *
     * @param string $refId
     * @return void
     */
    protected function set_payment_verify (string &$refId): void {
        $this->formParams->ref_id = $refId;
    }

    /**
     * Setting payment inquiry info
     *
     * @param string $refId
     * @return void
     */
    protected function set_payment_inquiry (string &$refId): void {
        $this->formParams->ref_id = $refId;
    }

    /**
     * Setting the reply keyboard parameter
     *
     * @param string|array $replyKeyboard <p>pass an array of keyboard or name string of template</p>
     * @return object
     */
    public function set_reply_keyboard (string|array $replyKeyboard): object {
        $this->formParams->reply_keyboard = $replyKeyboard;

        return $this;
    }

    /**
     * Setting a contact reply keyboard
     *
     * @param string $text
     * @return object
     */
    public function set_contact_keyboard (string $text): object {
        array_push ($this->formParams->info_keyboard , [['$contact' => $text]]);

        return $this;
    }

    /**
     * Setting a inline keyboard
     *
     * @param string|array $inlineKeyboard <p>pass an array of keyboard or string name of template</p>
     * @return object
     */
    public function set_inline_keyboard (string|array $inlineKeyboard): object {
        $this->formParams->inline_keyboard = $inlineKeyboard;

        return $this;
    }

    /**
     * Setting a inline keyboard for payments
     *
     * @param string $text
     * @param string $amount
     * @param string $desc
     * @param Currency $currency
     * @return string
     */
    public function set_payment_keyboard (string $text , string $amount , string $desc , Currency $currency = Currency::rial): string {
        $base64 = $this->base64 ();

        $paymentKeyboard = [
            'text' => $text ,
            'amount' => $amount ,
            'currency' => $currency->value ,
            'ref_id' => $base64 ,
            'desc' => $desc ,
        ];

        array_push ($this->formParams->paymentKeyboard , $paymentKeyboard);

        return $base64;
    }

    /**
     * Return a string of code base64
     *
     * @return string
     */
    private function base64 (): string {
        return base64_encode ($this->get_chat_id () . '.' . uniqid ());
    }

    /**
     * Setting a submit form
     *
     * @param string|array $form
     * @return object
     */
    public function set_form (string|array $form): object {
        $this->formParams->form = $form;

        return $this;
    }

    /**
     * Setting a location reply keyboard
     *
     * @param string $text
     * @return object
     */
    public function set_location_keyboard (string $text): object {
        array_push ($this->formParams->info_keyboard , [['$location' => $text]]);

        return $this;
    }

    /**
     * Setting edit message info
     *
     * @param string $messageId
     * @param string $newData
     * @return void
     */
    protected function set_edit_message (string &$messageId , string &$newData): void {
        $this->formParams->message_id = $messageId;

        $this->formParams->data = $newData;
    }

    /**
     * Setting delete message info
     *
     * @param string $messageId
     * @return void
     */
    protected function set_delete_message (string &$messageId): void {
        $this->formParams->message_id = $messageId;
    }

    /**
     * To initialize the formParams & multipart
     * & finally set the chat id
     *
     * @return void
     */
    private function init_params (): void {
        unset ($this->formParams);
        unset ($this->multipart);

        $this->formParams = new FormParams();
        $this->multipart = new Multipart();

        $this->set_chat_id ();
    }

    /**
     * Setting the upload info by "CURLFile"
     *
     * @param Types $fileType
     * @param string $imagePath
     * @return void
     */
    protected function set_upload_file (Types $fileType , string &$imagePath): void {
        $type = $fileType->name;

        $this->multipart->$type = new \CURLFile ($imagePath);
    }

    /**
     * Setting upload result for send message
     *
     * @param object|string $file
     * @param Types $type
     * @param string $description
     * @return void
     */
    protected function set_send_file (object|string $file , Types $type , string &$description): void {
        if (is_string ($file)) {
            $decoded = json_decode ($file , true);
        } else {
            $decoded = json_decode ($file->getBody () , true);
        }


        if (!key_exists ('type' , $decoded)) {
            $decoded ['type'] = $type->name;
        }

        if (key_exists ('type' , $decoded) && ($type->name == 'file' && $decoded['type'] != 'file')) {
            $decoded['type'] = 'file';
        }

        if ($description) {
            $decoded ['desc'] = $description;
        }

        $this->formParams->data = json_encode ($decoded);
    }

    /**
     * To setting a simple style
     *
     * Example $color:#ff0000
     *
     * @param string $text
     * @param bool $bold
     * @param bool $italic
     * @param bool $underline
     * @param string|null $color <p>Important: the sharp sign neccessary for this parameter</p>
     * @return object
     */
    public function set_style (string &$text , bool $bold = false , bool $italic = false , bool $underline = false , ?string $color = null): object {
        $this->set_bold_style ($text , $bold)
            ->set_italic_style ($text , $italic)
            ->set_underline_style ($text , $underline)
            ->set_color_style ($text , $color);

        return $this;
    }

    /**
     * Wraping the content into the b tag
     *
     * @param string $text
     * @param bool $bold
     * @return object
     */
    private function set_bold_style (string &$text , bool &$bold): object {
        if ($bold) {
            $text = '<b>' . $text . '</b>';
        }

        return $this;
    }

    /**
     * Wraping the content into the i tag
     *
     * @param string $text
     * @param bool $italic
     * @return object
     */
    private function set_italic_style (string &$text , bool &$italic): object {
        if ($italic) {
            $text = '<i>' . $text . '</i>';
        }

        return $this;
    }

    /**
     * Wraping the content into the u tag
     *
     * @param string $text
     * @param bool $underline
     * @return object
     */
    private function set_underline_style (string &$text , bool &$underline): object {
        if ($underline) {
            $text = '<u>' . $text . '</u>';
        }

        return $this;
    }

    /**
     * Wraping the content into the color tag
     *
     * @param string $text
     * @param string|null $color
     * @return object
     */
    private function set_color_style (string &$text , ?string &$color): object {
        if ($color) {
            $text = "<color$color>" . $text . "</color>";
        }

        return $this;
    }

}
