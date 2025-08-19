<?php
return array(
    'pdf' => array(
        'enabled' => true,
        'binary'  => env('WKHTML_PDF_BINARY', '/usr/local/bin/wkhtmltopdf'),
        'timeout' => false,
        'options' => array(
            'enable-local-file-access' => true,
        ),
        'env'     => array(),
    ),

    'image' => array(
        'enabled' => true,
        'binary'  => env('WKHTML_IMG_BINARY', '/usr/local/bin/wkhtmltoimage'),
        'timeout' => false,
        'options' => array(
            'enable-local-file-access' => true,
        ),
        'env'     => array(),
    ),

);
