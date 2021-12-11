<?php

namespace TheBachtiarz\UserLog\Job;

use TheBachtiarz\UserLog\Models\UserHistory;
use TheBachtiarz\UserLog\Traits\LogManagerTrait;

class UserHistoryJob
{
    use LogManagerTrait;

    private static int $id;
    private static int $userId;
    private static string $logCode;
    private static string $history;

    private static ?int $limitDays = null;

    public function __construct()
    {
        if (!self::$limitDays)
            self::$limitDays = tbuserlogconfig('limit_days');
    }

    // ? Public Methods
    /**
     * get list of user history
     *
     * @return object
     */
    public static function get(): object
    {
        return UserHistory::getUserHistoryLastDays(self::$userId, self::$limitDays)->get();
    }

    /**
     * create new user history
     *
     * @return object
     */
    public static function create(): object
    {
        return UserHistory::create([
            'user_id' => self::$userId,
            'log_manager_id' => self::logCodeToLogId(self::$logCode),
            'history' => self::$history
        ]);
    }

    /**
     * get detail of user history
     *
     * @return object
     */
    public static function find(): object
    {
        return UserHistory::getByUserId(self::$userId)->find(self::$id);
    }

    // ? Setter Modules
    /**
     * set user history id
     *
     * @param int $id
     * @return self
     */
    public static function setId(int $id): self
    {
        self::$id = $id;

        return new self;
    }

    /**
     * set user history user id
     *
     * @param integer $userId
     * @return self
     */
    public static function setUserId(int $userId): self
    {
        self::$userId = $userId;

        return new self;
    }

    /**
     * set user history log code
     *
     * @param string $logCode
     * @return self
     */
    public static function setLogCode(string $logCode): self
    {
        self::$logCode = $logCode;

        return new self;
    }

    /**
     * set user history information
     *
     * @param string $history
     * @return self
     */
    public static function setHistory(string $history): self
    {
        self::$history = $history;

        return new self;
    }

    /**
     * set limit days of history
     *
     * @param integer|null $limitDays
     * @return self
     */
    public static function setLimitDays(?int $limitDays = null): self
    {
        self::$limitDays = $limitDays;

        return new self;
    }
}
