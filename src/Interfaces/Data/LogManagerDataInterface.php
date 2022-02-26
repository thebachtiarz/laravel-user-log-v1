<?php

namespace TheBachtiarz\UserLog\Interfaces\Data;

interface LogManagerDataInterface
{
    /**
     * Log Management Data
     */
    public const LOG_MANAGEMENT_DATA = [
        ['name_type' => 'general', 'alt_code' => self::LOG_SCAPEGOAT, 'description' => self::LOG_SCAPEGOAT_DESC],

        ['name_type' => 'auth_system', 'alt_code' => self::REGISTER_CREATE_MEMBER, 'description' => self::REGISTER_CREATE_MEMBER_DESC],
        ['name_type' => 'auth_system', 'alt_code' => self::REGISTER_UPDATE_MEMBER, 'description' => self::REGISTER_UPDATE_MEMBER_DESC],
        ['name_type' => 'auth_system', 'alt_code' => self::AUTH_LOGIN, 'description' => self::AUTH_LOGIN_DESC],
        ['name_type' => 'auth_system', 'alt_code' => self::AUTH_LOGOUT, 'description' => self::AUTH_LOGOUT_DESC],
        ['name_type' => 'auth_system', 'alt_code' => self::AUTH_LOGOUT_REVOKE, 'description' => self::AUTH_LOGOUT_REVOKE_DESC],
        ['name_type' => 'auth_system', 'alt_code' => self::AUTH_RENEW_PASSWORD, 'description' => self::AUTH_RENEW_PASSWORD_DESC],
    ];

    /**
     * default scapegoat log code
     */
    public const LOG_SCAPEGOAT_ID = 1;
    public const LOG_SCAPEGOAT = "999999";

    public const LOG_SCAPEGOAT_DESC = "Scapegoat log, server cannot understand the request";

    /**
     * Register log code
     */
    public const REGISTER_CREATE_MEMBER = "100110";
    public const REGISTER_UPDATE_MEMBER = "100120";

    public const REGISTER_CREATE_MEMBER_DESC = "A new user has been created";
    public const REGISTER_UPDATE_MEMBER_DESC = "The new user has updated";

    /**
     * Auth log code
     */
    public const AUTH_LOGIN = "100130";
    public const AUTH_LOGOUT = "100140";
    public const AUTH_LOGOUT_REVOKE = "100141";
    public const AUTH_RENEW_PASSWORD = "100150";

    public const AUTH_LOGIN_DESC = "The user is signed in to account";
    public const AUTH_LOGOUT_DESC = "The user is signed out from account";
    public const AUTH_LOGOUT_REVOKE_DESC = "The user is revoke from all logins";
    public const AUTH_RENEW_PASSWORD_DESC = "The user has been renew password";
}
