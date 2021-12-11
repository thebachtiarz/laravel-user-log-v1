<?php

namespace TheBachtiarz\UserLog\Job;

use TheBachtiarz\Toolkit\Helper\App\Converter\ArrayHelper;
use TheBachtiarz\UserLog\Models\UserHistory;

class HistoryLocationJob
{
    use ArrayHelper;

    private static User $user;

    private static UserHistory $userHistory;

    private static string $location;

    // ? Public Methods
    /**
     * get history location list by user
     *
     * @return object|null
     */
    public static function get(): ?object
    {
        return self::getHistoryLocation();
    }

    /**
     * create history location by user
     *
     * @return object|null
     */
    public static function create(): ?object
    {
        return self::createNewHistoryLocation();
    }

    /**
     * show detail history location by user
     *
     * @return object|null
     */
    public static function show(): ?object
    {
        return self::showHistoryLocationDetail();
    }

    // ? Public Helper
    /**
     * history location setter template helper
     *
     * @return string
     */
    public static function historyLocationSetTemplate(): string
    {
        $historyProcess = [];

        try {
            $arrayLocation = self::jsonDecode(self::$location);

            $historyKeys = tbuserlogconfig('location_keys');

            foreach ($historyKeys as $key => $historyKey)
                $historyProcess[$historyKey] = $arrayLocation[$historyKey] ?? null;
        } catch (\Throwable $th) {
            $historyProcess = [];
        } finally {
            return self::jsonEncode($historyProcess);
        }
    }

    // ? Private Methods
    /**
     * get history location list by user process
     *
     * @return object|null
     */
    private static function getHistoryLocation(): ?object
    {
        try {
            return self::getUserHistoryByUser()->historylocation;
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * create history location by user process
     *
     * @return object|null
     */
    private static function createNewHistoryLocation(): ?object
    {
        try {
            return self::getUserHistoryByUserHistory()->historylocation()->create([
                'location' => self::historyLocationSetTemplate()
            ]);
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * show detail history location by user process
     *
     * @return object|null
     */
    private static function showHistoryLocationDetail(): ?object
    {
        try {
            return self::getUserHistoryByUserHistory()->historylocation;
        } catch (\Throwable $th) {
            return null;
        }
    }

    // ? Private Core Process
    /**
     * get user history data by user
     *
     * @return object|null
     */
    private static function getUserHistoryByUser(): ?object
    {
        try {
            return self::$user->userhistory;
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * get user history data by user history
     *
     * @return object|null
     */
    private static function getUserHistoryByUserHistory(): ?object
    {
        try {
            return self::$userHistory;
        } catch (\Throwable $th) {
            return null;
        }
    }

    // ? Setter Modules
    /**
     * set [User] data
     *
     * @param User $user
     * @return self
     */
    public static function setUser(User $user): self
    {
        self::$user = $user;

        return new self;
    }

    /**
     * set [UserHistory] data
     *
     * @param UserHistory $userHistory
     * @return self
     */
    public static function setUserHistory(UserHistory $userHistory): self
    {
        self::$userHistory = $userHistory;

        return new self;
    }

    /**
     * set location data
     *
     * @param string $location
     * @return self
     */
    public static function setLocation(string $location): self
    {
        self::$location = $location;

        return new self;
    }
}
