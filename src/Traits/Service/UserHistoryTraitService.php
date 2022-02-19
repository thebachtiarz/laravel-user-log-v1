<?php

namespace TheBachtiarz\UserLog\Traits\Service;

use TheBachtiarz\Auth\Model\User;
use TheBachtiarz\UserLog\Job\UserHistoryJob;
use TheBachtiarz\UserLog\Models\LogManager;

/**
 * User History Trait Service
 */
trait UserHistoryTraitService
{
    /**
     * create user history
     *
     * @param User $user
     * @param string $logCode
     * @param string $historyMessage
     * @param string|null $historyLocation
     * @return boolean
     */
    private static function createUserHistory(User $user, string $logCode, string $historyMessage, ?string $historyLocation = null): bool
    {
        try {
            $_logManager = LogManager::getByCode($logCode)->first();

            throw_if(!$_logManager, 'Exception', "Unknow log code");

            $_createUserHistory = UserHistoryJob::setUser($user)
                ->setLogManager($_logManager)
                ->setLogHistory($historyMessage);

            if ($historyLocation)
                $_createUserHistory = $_createUserHistory->setLogHistoryLocation($historyLocation);

            $_createUserHistory = $_createUserHistory->create();

            return $_createUserHistory['status'];
        } catch (\Throwable $th) {
            return false;
        }
    }
}
