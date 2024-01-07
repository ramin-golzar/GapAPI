<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Handlers\Multipart;
use App\Libraries\GapAPI\Send\Handlers\Currency;
use App\Libraries\GapAPI\Send\Handlers\Types;

class SetParams
{

    protected ?FormParams $formParams;
    protected ?Multipart $multipart;

    public function __construct () {
        $this->formParams = new FormParams();

        $this->multipart = new Multipart();
    }

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

    protected function set_data (string $data): void {
        $this->formParams->data = $data;
    }

    protected function set_contact (string &$phone , string &$name): void {
        $data = [
            'phone' => $phone ,
            'name' => $name ,
        ];

        $this->formParams->data = json_encode ($data);
    }

    protected function set_location (string &$lat , string &$long , string &$description): void {
        $data = [
            'lat' => $lat ,
            'lang' => $long ,
            'desc' => $description ,
        ];

        $this->formParams->data = json_encode ($data);
    }

    protected function set_text (string &$text): void {
        $this->formParams->text = $text;
    }

    protected function set_answer_callback (string &$text , string &$callbackId , bool &$showAlert = false): void {
        $this->formParams->text = $text;

        $this->formParams->callback_id = $callbackId;

        $this->formParams->show_alert = $showAlert;
    }

    protected function set_invoice (string &$amount , string &$description , string &$expirTime = '86400' , Currency $currency = Currency::rial): void {
        $this->formParams->amount = $amount;

        $this->formParams->currency = $currency->value;

        $this->formParams->description = $description;

        $this->formParams->expir_time = $expirTime;
    }

    protected function set_invoice_inquiry (string $invoiceId): void {
        $this->formParams->ref_id = $invoiceId;
    }

    protected function set_payment_verify (string &$refId): void {
        $this->formParams->ref_id = $refId;
    }

    protected function set_payment_inquiry (string &$refId): void {
        $this->formParams->ref_id = $refId;
    }

    public function set_reply_keyboard (string|array $replyKeyboard): object {
        $this->formParams->reply_keyboard = $replyKeyboard;

        return $this;
    }

    public function set_contact_keyboard (string $text): object {
        array_push ($this->formParams->info_keyboard , [['$contact' => $text]]);

        return $this;
    }

    public function set_location_keyboard (string $text): object {
        array_push ($this->formParams->info_keyboard , [['$location' => $text]]);

        return $this;
    }

    protected function set_edit_message (string &$messageId , string &$newData): void {
        $this->formParams->message_id = $messageId;
        $this->formParams->data = $newData;
    }

    protected function set_delete_message (string &$messageId): void {
        $this->formParams->message_id = $messageId;
    }

    public function set_inline_keyboard (string|array $inlineKeyboard): object {
        $this->formParams->inline_keyboard = $inlineKeyboard;

        return $this;
    }

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

    private function base64 (): string {
        /* ToDo: must added a chat id to it code */
        return base64_encode (uniqid ());
    }

    public function set_form (string|array $form): object {
        $this->formParams->form = $form;

        return $this;
    }

    private function reset_params (): void {
        unset ($this->formParams);
        unset ($this->multipart);

        $this->formParams = new FormParams();
        $this->multipart = new Multipart();
    }

    protected function set_upload_file (Types $fileType , string &$imagePath): void {
        $type = $fileType->name;

        $this->multipart->$type = new \CURLFile ($imagePath);
    }

    protected function set_send_file (object|string $file , Types $type , string &$description): void {
        if (is_string ($file)) {
            $decoded = json_decode ($file , true);
        } else {
            $decoded = json_decode ($file->getBody () , true);
        }


        if (!key_exists ('type' , $decoded)) {
            $decoded ['type'] = $type->name;
        }

        if ($description) {
            $decoded ['desc'] = $description;
        }

        $this->formParams->data = json_encode ($decoded);
    }

    protected function request (object &$sendClass , bool $resetParams = true): object {
        $response = $sendClass->request ();

        if ($resetParams) {
            $this->reset_params ();
        }

        return $response;
    }

}
