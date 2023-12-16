<?php
namespace App\Libraries\GapAPI\Templates;

class InlineKeyboard
{

    public array $example = [
        [
            [
                'text' => 'File' ,
                'cb_data' => 'get film' ,
            ] ,
            [
                'text' => 'Photo' ,
                'cb_data' => 'get photo' ,
            ]
        ] ,
        [
            [
                'text' => 'Cancel' ,
                'cb_data' => 'cancel' ,
            ]
        ]
    ];

}
