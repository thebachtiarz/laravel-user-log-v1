<?php

namespace TheBachtiarz\UserLog\Traits\Model\Log;

use Illuminate\Support\Facades\DB;

/**
 * Log Manager Scope Trait
 */
trait LogManagerScopeTrait
{
    /**
     * Get log manager by code
     *
     * @param string $logCode
     * @return object|null
     */
    public function scopeGetByCode($query, string $logCode): ?object
    {
        return $query->where(DB::raw("BINARY `alt_code`"), $logCode);
    }
}
