<?php
namespace App\Libraries\GapAPI\Templates;

class InlineKeyboard
{
    /*
     * Allowed keys for inline keyboard:
     * - text
     * - cb_data
     * - url
     * - open_in
     * - amount
     * - currency
     * - ref_id
     * - desc
     */

    /**
     * This is a example for inline keyboard template
     *
     * @var array
     */
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
