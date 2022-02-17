<?php

namespace TheBachtiarz\UserLog\Job;

use TheBachtiarz\Toolkit\Helper\App\Converter\ArrayHelper;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;
use TheBachtiarz\UserLog\Models\{HistoryLocation, UserHistory};

class HistoryLocationJob
{
    use ErrorLogTrait, ArrayHelper;

    /**
     * Model User History data
     *
     * @var UserHistory
     */
    protected static UserHistory $userHistory;

    /**
     * Model History Location data
     *
     * @var HistoryLocation
     */
    protected static HistoryLocation $historyLocation;

    /**
     * location data
     *
     * @var string
     */
    protected static string $locationData;

    // ? Public Methods
    /**
     * create new user history location
     *
     * @param boolean $map
     * @return array
     */
    public static function create(bool $map = false): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            $_create = HistoryLocation::create([
                'user_history_id' => self::$userHistory->id,
                'location' => self::locationSetterResolver()
            ]);

            throw_if(!$_create, 'Exception', "Failed to create history location");

            $result['data'] = $_create;
            $result['status'] = true;
            $result['message'] = "Successfully create history location";
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();

            self::logCatch($th);
        } finally {
            return $result;
        }
    }

    // ? Private Methods
    /**
     * history location setter resolver
     *
     * @return string
     */
    public static function locationSetterResolver(): string
    {
        $historyProcess = [];

        try {
            $arrayLocation = self::jsonDecode(self::$locationData);

            $historyKeys = tbuserlogconfig('location_keys');

            foreach ($historyKeys as $key => $historyKey)
                $historyProcess[$historyKey] = $arrayLocation[$historyKey] ?? null;
        } catch (\Throwable $th) {
            $historyProcess = [];
        } finally {
            return self::jsonEncode($historyProcess);
        }
    }

    // ? Setter Modules
    /**
     * Set model User History data
     *
     * @param UserHistory $userHistory Model User History data
     * @return self
     */
    public static function setUserHistory(UserHistory $userHistory): self
    {
        self::$userHistory = $userHistory;

        return new self;
    }

    /**
     * Set model History Location data
     *
     * @param HistoryLocation $historyLocation Model History Location data
     * @return self
     */
    public static function setHistoryLocation(HistoryLocation $historyLocation): self
    {
        self::$historyLocation = $historyLocation;

        return new self;
    }

    /**
     * Set location data
     *
     * @param string $locationData location data
     * @return self
     */
    public static function setLocationData(string $locationData): self
    {
        self::$locationData = $locationData;

        return new self;
    }
}
