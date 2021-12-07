<?php

return [
    'user_class' => \Models\User\User::class,

    'limit_days' => 30,

    'location_keys' => ['latitude', 'longitude', 'altitude', 'accuracy', 'altitudeAccuracy', 'heading', 'speed', 'timestamp']
];
