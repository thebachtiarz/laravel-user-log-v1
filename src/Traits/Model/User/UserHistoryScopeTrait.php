<?php

namespace TheBachtiarz\UserLog\Traits\Model\User;

use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;

/**
 * User History Scope Trait
 */
trait UserHistoryScopeTrait
{
    use CarbonHelper;

    /**
     * get user history by user id
     *
     * @param integer $userId
     * @return object|null
     */
    public function scopeGetByUserId($query, int $userId): ?object
    {
        return $query->where('user_id', $userId);
    }

    /**
     * get user history
     *
     * @param integer $userId
     * @param integer|null $days
     * @return object|null
     */
    public function scopeGetHistories($query, int $userId, ?int $days = null): ?object
    {
        $days = $days ?: tbuserlogconfig('limit_days');

        return $query->getByUserId($userId)->where('created_at', '>=', self::dbGetFullDateSubDays($days));
    }

    /**
     * get user history by log manager id
     *
     * @param integer $userId
     * @param array $logIds
     * @param integer|null $days
     * @return object|null
     */
    public function scopeGetHistoriesByLogId($query, int $userId, array $logIds, ?int $days = null): ?object
    {
        $days = $days ?: tbuserlogconfig('limit_days');

        return $query->getHistories($userId, $days)->whereIn('log_manager_id', $logIds);
    }
}
