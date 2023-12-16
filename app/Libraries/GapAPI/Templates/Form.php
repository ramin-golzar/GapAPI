<?php
namespace App\Libraries\GapAPI\Templates;

class Form
{

    public array $example = [
        [
            'type' => 'text' ,
            'name' => 'name' ,
            'label' => 'Your Name' ,
        ] ,
        [
            'type' => 'textarea' ,
            'name' => 'address' ,
            'label' => 'Address' ,
        ] ,
        [
            'type' => 'submit' ,
            'name' => 'send' ,
        ] ,
    ];

}
