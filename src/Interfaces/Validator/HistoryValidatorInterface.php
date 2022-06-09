<?php

namespace TheBachtiarz\UserLog\Interfaces\Validator;

interface HistoryValidatorInterface
{
    // ? Rules

    /**
     * History location rules
     */
    public const HISTORY_LOCATION_RULES = [
        'location' => ["nullable", "string"]
    ];

    // ? Messages

    /**
     * History location message
     */
    public const HISTORY_LOCATION_MESSAGES = [
        'location.string' => 'Location cannot be accepted'
    ];
}
