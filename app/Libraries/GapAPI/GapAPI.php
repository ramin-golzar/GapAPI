<?php
namespace App\Libraries\GapAPI;

use App\Libraries\GapAPI\SetParams;
use App\Libraries\GapAPI\Send\Handlers\URLs;
use App\Libraries\GapAPI\Send\SendMessage;
use App\Libraries\GapAPI\Send\Contact;
use App\Libraries\GapAPI\Send\Location;
use App\Libraries\GapAPI\Send\Action;
use App\Libraries\GapAPI\Send\AnswerCallback;
use App\Libraries\GapAPI\Send\Invoice;
use App\Libraries\GapAPI\Send\Handlers\Currency;
use App\Libraries\GapAPI\Send\InvoiceVerify;
use App\Libraries\GapAPI\Send\InvoiceInquiry;
use App\Libraries\GapAPI\Send\PaymentVerify;
use App\Libraries\GapAPI\Send\PaymentInquiry;

class GapAPI extends SetParams
{

    /**
     * This is cURL object
     *
     * @var object
     */
    private object $client;

    public function __construct (string &$token) {
        parent::__construct ();

        $this->client = \Config\Services::curlrequest ($this->get_base_options ($token));
    }

    /**
     * Return the base options for cURL
     *
     * @return array
     */
    private function get_base_options (string &$token): array {
        return [
            'headers' => [
                'token' => $token ,
            ] ,
            'baseURI' => URLs::base_url->value ,
        ];
    }

    /**
     * Sending evetything except upload file
     *
     * @param string $token
     * @return object
     */
    public function send_text (string $text): object {
        $this->set_data ($text);

        $sendMessage = new SendMessage ($this->client , $this->formParams);

        return $this->request ($sendMessage);
    }

    public function send_contact (string $phone , string $name): object {
        $this->set_contact ($phone , $name);

        $contact = new Contact ($this->client , $this->formParams);

        return $this->request ($contact);
    }

    public function send_location (string $lat , string $long , string $description): object {
        $this->set_location ($lat , $long , $description);

        $location = new Location ($this->client , $this->formParams);

        return $this->request ($location);
    }

    public function send_action (): object {
        $action = new Action ($this->client , $this->formParams);

        return $this->request ($action);
    }

    public function send_answer_callback (string $text , string $callbackId , bool $showAlert = false): object {
        $this->set_answer_callback ($text , $callbackId , $showAlert);

        $answerCallback = new AnswerCallback ($this->client , $this->formParams);

        return $this->request ($answerCallback);
    }

    public function send_invoice (string $amount , string $description , string $expirTime = '86400' , Currency $currency = Currency::rial): object {
        $this->set_invoice ($amount , $description , $expirTime , $currency);

        $invoice = new Invoice ($this->client , $this->formParams);

        return $this->request ($invoice);
    }

    public function send_invoice_verify (string $invoiceId): object {
        $this->formParams->ref_id = $invoiceId;

        $invoiceVeryfy = new InvoiceVerify ($this->client , $this->formParams);

        return $this->request ($invoiceVeryfy);
    }

    public function send_invoice_inquiry (string $invoiceId): object {
        $this->set_invoice_inquiry ($invoiceId);

        $invoiceInquiry = new InvoiceInquiry ($this->client , $this->formParams);

        return $this->request ($invoiceInquiry);
    }

    public function send_payment_verify (string $refId): object {
        $this->set_payment_verify ($refId);

        $paymentVerify = new PaymentVerify ($this->client , $this->formParams);

        return $this->request ($paymentVerify);
    }

    public function send_payment_inquiry (string $refId): object {
        $this->set_payment_inquiry ($refId);

        $paymentInquiry = new PaymentInquiry ($this->client , $this->formParams);

        return $this->request ($paymentInquiry);
    }

}

// this code fot test the connection
/*
    public function send (string $chatId): void {
        $client = \Config\Services::curlrequest ();

        $url = 'https://api.gap.im/sendMessage/';

        $option = [
            'headers' => [
                'token' => '18b34dbfab054137d021173fbcc12fc0ee01bca35c8a2d52b566585b1ff71496' ,
            ] ,
            'form_params' => [
                'chat_id' => $chatId ,
                'type' => 'text' ,
                'data' => 'Hello, Welcome to my robot' ,
            ] ,
        ];

        $response = $client->request ('POST' , $url , $option);
    }
 */