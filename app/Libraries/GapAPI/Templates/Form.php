<?php
namespace App\Libraries\GapAPI\Templates;

class Form
{

    public array $example = [
        [
            'name' => 'username' ,
            'type' => 'text' ,
            'lable' => 'User Name:' ,
        ] ,
        [
            'name' => 're_me' ,
            'type' => 'radio' ,
            'lable' => 'Remember Me' ,
        ] ,
        [
            'name' => 'send' ,
            'type' => 'submit' ,
            'text' => 'Send' ,
        ]
    ];

}
