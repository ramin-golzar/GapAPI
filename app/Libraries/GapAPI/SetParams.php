<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\Handlers\FormParams;
use App\Libraries\GapAPI\Send\Handlers\Currency;

class SetParams
{

    public FormParams $formParams;

    public function __construct () {
        $this->formParams = new FormParams();
    }

    public function set_chat_id (string|int $chatId): void {
        $this->formParams->chat_id = $chatId;
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

    public function set_reply_keyboard (string|array $replyKeyboard): void {
        $this->formParams->reply_keyboard = $replyKeyboard;
    }

    public function set_contact_keyboard (string $text): void {
        array_push ($this->formParams->info_keyboard , [['$contact' => $text]]);
    }

    public function set_location_keyboard (string $text): void {
        array_push ($this->formParams->info_keyboard , [['$location' => $text]]);
    }

    protected function set_edit_message (string &$messageId , string &$newData): void {
        $this->formParams->message_id = $messageId;
        $this->formParams->data = $newData;
    }

    protected function set_delete_message (string &$messageId): void {
        $this->formParams->message_id = $messageId;
    }

    public function set_inline_keyboard (string|array $inlineKeyboard): void {
        $this->formParams->inline_keyboard = $inlineKeyboard;
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

    public function set_form (string|array $form): void {
        $this->formParams->form = $form;
    }

    private function reset_form_params (): void {
        unset ($this->formParams);

        $this->formParams = new FormParams();
    }

    protected function request (object &$sendClass): object {
        $response = $sendClass->request ();

        $this->reset_form_params ();

        return $response;
    }

}
