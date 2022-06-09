<?php

namespace TheBachtiarz\UserLog\Interfaces\Validator;

use TheBachtiarz\Toolkit\Helper\Interfaces\Validator\GlobalValidatorInterface;

interface LogValidatorInterface
{
    // ? Rules

    /**
     * Log code validator rules
     */
    public const LOG_CODE_RULES = [
        'code' => ["required", "numeric"],
    ];

    /**
     * Log create validator rules
     */
    public const LOG_CREATE_RULES = [
        'type' => ["required", "string", "alpha_dash"],
        'info' => ["required", "string", GlobalValidatorInterface::RULES_REGEX_NAME_ADVANCE]
    ] + self::LOG_CODE_RULES;

    /**
     * Log update validator rules
     */
    public const LOG_UPDATE_RULES = [
        'type' => ["required", "string", "alpha_dash"],
        'info' => ["required", "string", GlobalValidatorInterface::RULES_REGEX_NAME_ADVANCE]
    ];

    // ? Messages

    /**
     * Log code validator messages
     */
    public const LOG_CODE_MESSAGES = [
        'code.numeric' => 'Log code must be an numeric character',
    ];

    /**
     * Log create validator messages
     */
    public const LOG_CREATE_MESSAGES = [
        'type.alpha_dash' => 'Log type cannot be accepted',
        'info.regex' => 'Log info cannot be accepted'
    ] + self::LOG_CODE_MESSAGES;

    /**
     * Log update validator messages
     */
    public const LOG_UPDATE_MESSAGES = [
        'type.alpha_dash' => 'Log type cannot be accepted',
        'info.regex' => 'Log info cannot be accepted'
    ];
}
