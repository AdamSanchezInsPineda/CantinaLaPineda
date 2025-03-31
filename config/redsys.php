<?php

return [
    'merchant_code' => env('REDSYS_MERCHANT_CODE', ''),
    'terminal' => env('REDSYS_TERMINAL', '1'),
    'currency' => env('REDSYS_CURRENCY', '978'),
    'environment' => env('REDSYS_ENVIRONMENT', 'test'),
    'key' => env('REDSYS_KEY', ''),
    'url_test' => 'https://sis-t.redsys.es:25443/sis/realizarPago',
    'url_live' => 'https://sis.redsys.es/sis/realizarPago',
];
