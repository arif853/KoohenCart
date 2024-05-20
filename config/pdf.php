<?php

return [
    'font_path' => base_path('resources/fonts/'),
	'font_data'         => [
        'nikosh' => [
            'R'  => 'Nikosh.ttf',
            'B'  => 'Nikosh.ttf',
            'I'  => 'Nikosh.ttf',
            'BI' => 'Nikosh.ttf',
            'useOTL' => 0xFF,
            ]
        ],
        'mode'                  => 'utf-8',
        'format'                => 'A5',
        'margin_left'          => 8,
        'margin_right'         => 8,
        'margin_top'           => 10,
        'margin_bottom'        => 10,
        'margin_header'        => 0,
        'margin_footer'        => 0,
        'orientation'          => 'P',
        'title'                => 'Koohen',
        'author'               => 'koohen Ecommerce',
        'watermark'            => 'KOOHEN',
        'show_watermark'       => false,
        'subject'               => '',
        'keywords'              => '',
        'creator'               => 'Koohen',
        'display_mode'          => 'fullpage',
        'tempDir'               => base_path('storage/app/mpdf'),
        'ALLOWED_URI_SCHEMES'   => ['data', 'http', 'https', 'ftp', 'ftps', 'file'],
        'pdf_a'                 => false,
        'pdf_a_auto'            => false,
        'icc_profile_path'      => ''
];
