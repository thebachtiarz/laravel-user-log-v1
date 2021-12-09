<?php

return [
    /*
    |--------------------------------------------------------------------------
    | User class location
    |--------------------------------------------------------------------------
    | Define user class location
    |
    */
    'user_class' => \Models\User\User::class,

    /*
    |--------------------------------------------------------------------------
    | Log limit past days
    |--------------------------------------------------------------------------
    | Define log limit past days
    |
    */
    'limit_days' => 30,

    /*
    |--------------------------------------------------------------------------
    | Allowed log location keys
    |--------------------------------------------------------------------------
    | Define allowed log location keys
    |
    */
    'location_keys' => ['latitude', 'longitude', 'altitude', 'accuracy', 'altitudeAccuracy', 'heading', 'speed', 'timestamp'],

    /*
    |--------------------------------------------------------------------------
    | Log data management
    |--------------------------------------------------------------------------
    | Define log data management
    |
    */
    'log_data_management' => [],

    /*
    |--------------------------------------------------------------------------
    | Log data allowed general access
    |--------------------------------------------------------------------------
    | Define log data allowed general access
    |
    */
    'log_allowed_general_access' => [],

    /*
    |--------------------------------------------------------------------------
    | Log data allowed user access
    |--------------------------------------------------------------------------
    | Define log data allowed user access
    |
    */
    'log_allowed_user_access' => []
];
