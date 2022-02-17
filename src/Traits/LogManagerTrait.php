<?php

namespace TheBachtiarz\UserLog\Traits;

use TheBachtiarz\UserLog\Models\LogManager;

trait LogManagerTrait
{
    /**
     * Get log by log code
     *
     * @param string $logCode
     * @return object
     */
    public static function getLogByLogCode(string $logCode): object
    {
        return LogManager::getLogByCode($logCode);
    }

    /**
     * Translate log code to log id
     *
     * @param string $logCode
     * @return integer
     */
    public static function logCodeToLogId(string $logCode): int
    {
        $getLog = self::getLogByLogCode($logCode);
        return $getLog->first() ? $getLog->id : tbuserlogconfig('log_id_error_default');
    }
}
