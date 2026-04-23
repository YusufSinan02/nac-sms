<?php

return [
    'username' => env('NAC_SMS_USERNAME', ''),
    'password' => env('NAC_SMS_PASSWORD', ''),
    'base_url' => env('NAC_SMS_BASE_URL', 'https://smslogin.nac.com.tr'),
    'sender'   => env('NAC_SMS_SENDER', ''),
];
