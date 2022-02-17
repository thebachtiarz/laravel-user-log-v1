<?php

namespace TheBachtiarz\UserLog\Interfaces\Data;

interface LogManagerDataInterface
{
    public const LOG_DATA_MANAGEMENT = [
        ['name_type' => 'general', 'alt_code' => self::LOG_SCAPEGOAT, 'description' => 'Scapegoat log, server cannot understand the request'],

        ['name_type' => 'auth_system', 'alt_code' => self::REGISTER_CREATE_MEMBER, 'description' => 'A new user has been created'],
        ['name_type' => 'auth_system', 'alt_code' => self::REGISTER_UPDATE_MEMBER, 'description' => 'The new user has updated'],
        ['name_type' => 'auth_system', 'alt_code' => self::AUTH_LOGIN, 'description' => 'The user is signed in to account'],
        ['name_type' => 'auth_system', 'alt_code' => self::AUTH_LOGOUT, 'description' => 'The user is signed out from account'],
        ['name_type' => 'auth_system', 'alt_code' => self::AUTH_LOGOUT_REVOKE, 'description' => 'The user is revoke from all logins'],
        ['name_type' => 'auth_system', 'alt_code' => self::AUTH_RENEW_PASSWORD, 'description' => 'The user has been renew password'],
    ];

    /**
     * default scapegoat log code
     */
    public const LOG_SCAPEGOAT_ID = 1;
    public const LOG_SCAPEGOAT = '999999';

    /**
     * Register log code
     */
    public const REGISTER_CREATE_MEMBER = '100110';
    public const REGISTER_UPDATE_MEMBER = '100120';

    /**
     * Auth log code
     */
    public const AUTH_LOGIN = '100130';
    public const AUTH_LOGOUT = '100140';
    public const AUTH_LOGOUT_REVOKE = '100141';
    public const AUTH_RENEW_PASSWORD = '100150';
}
