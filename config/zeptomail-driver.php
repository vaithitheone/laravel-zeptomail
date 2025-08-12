<?php

return [
    'api_key' =>  env('ZEPTOMAIL_TOKEN'),
    'host' => env('ZEPTOMAIL_HOST'),
    'ssl_verify' => env('ZEPTOMAIL_SSL_VERIFY', true),
];
