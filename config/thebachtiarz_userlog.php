<?php

return [
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
    | Location Parameter Name
    |--------------------------------------------------------------------------
    | Define parameter name for location
    |
    */
    'location_param_name' => "location",

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
    | Log id error default
    |--------------------------------------------------------------------------
    | Define log id error default
    |
    */
    'log_id_error_default' => \TheBachtiarz\UserLog\Interfaces\Data\LogManagerDataInterface::LOG_SCAPEGOAT_ID,

];
