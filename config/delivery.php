<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Delivery Zones
    |--------------------------------------------------------------------------
    |
    | The delivery options offered at checkout. The array key is what gets
    | submitted and stored on the order, so changing a key breaks existing
    | orders. Charges are in BDT.
    |
    */

    'zones' => [

        'inside_dhaka' => [
            'label' => 'Inside Dhaka',
            'charge' => 60,
        ],

        'outside_dhaka' => [
            'label' => 'Outside Dhaka',
            'charge' => 120,
        ],

    ],

    'default_zone' => 'inside_dhaka',

];
