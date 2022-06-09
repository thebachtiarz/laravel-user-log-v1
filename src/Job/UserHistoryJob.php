<?php

namespace TheBachtiarz\UserLog\Job;

use Illuminate\Support\Facades\DB;
use TheBachtiarz\Auth\Model\User;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;
use TheBachtiarz\UserLog\Models\{HistoryLocation, LogManager, UserHistory};

class UserHistoryJob
{
    use ErrorLogTrait;

    /**
     * Model User data
     *
     * @var User
     */
    protected static User $user;

    /**
     * Model Log Manager data
     *
     * @var LogManager
     */
    protected static LogManager $logManager;

    /**
     * Model History Location data
     *
     * @var HistoryLocation
     */
    protected static HistoryLocation $historyLocation;

    /**
     * Protected log code
     *
     * @var string
     */
    protected static string $logCode;

    /**
     * Log history
     *
     * @var string
     */
    protected static string $logHistory;

    /**
     * Log history location
     *
     * @var string|null
     */
    protected static ?string $logHistoryLocation = null;

    /**
     * Limit history days
     *
     * @var integer|null
     */
    protected static ?int $limitDays = null;

    // ? Public Methods
    /**
     * Create new user history
     *
     * @param boolean $map
     * @return array
     */
    public static function create(bool $map = false): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            DB::beginTransaction();

            $_create = UserHistory::create([
                'user_id' => self::$user->id,
                'log_manager_id' => self::$logManager->id,
                'history' => self::$logHistory
            ]);

            throw_if(!$_create, 'Exception', "Failed to create user history");

            if (iconv_strlen(self::$logHistoryLocation))
                HistoryLocationJob::setUserHistory($_create)->setLocationData(self::$logHistoryLocation)->create();

            DB::commit();

            $result['data'] = $map ? $_create->simpleListMap() : $_create;
            $result['status'] = true;
            $result['message'] = "Successfully create user history";
        } catch (\Throwable $th) {
            DB::rollBack();

            $result['message'] = $th->getMessage();

            self::logCatch($th);
        } finally {
            return $result;
        }
    }

    /**
     * Get user histories
     *
     * @param boolean $map
     * @return array
     */
    public static function getHistories(bool $map = false): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            $_histories = UserHistory::getHistories(self::$user->id, self::$limitDays);

            throw_if(!$_histories->count(), 'Exception', "There is no histories");

            $result['data'] = $map ? $_histories->get()->map->simpleListMap() : $_histories->get();
            $result['status'] = true;
            $result['message'] = "User histories";
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();

            self::logCatch($th);
        } finally {
            return $result;
        }
    }

    /**
     * Get user histories by log manager
     *
     * @param boolean $map
     * @return array
     */
    public static function getHistoriesByLogManager(bool $map = false): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            $_histories = UserHistory::getHistoriesByLogId(self::$user->id, self::$logManager->id, self::$limitDays);

            throw_if(!$_histories->count(), 'Exception', "There is no histories");

            $result['data'] = $map ? $_histories->get()->map->simpleListMap() : $_histories->get();
            $result['status'] = true;
            $result['message'] = "User histories";
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();

            self::logCatch($th);
        } finally {
            return $result;
        }
    }

    // ? Setter Modules
    /**
     * Set model User data
     *
     * @param User $user Model User data
     * @return self
     */
    public static function setUser(User $user): self
    {
        self::$user = $user;

        return new self;
    }

    /**
     * Set model Log Manager data
     *
     * @param LogManager $logManager Model Log Manager data
     * @return self
     */
    public static function setLogManager(LogManager $logManager): self
    {
        self::$logManager = $logManager;

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
     * Set protected log code
     *
     * @param string $logCode protected log code
     * @return self
     */
    public static function setLogCode(string $logCode): self
    {
        self::$logCode = $logCode;

        return new self;
    }

    /**
     * Set log history
     *
     * @param string $logHistory log history
     * @return self
     */
    public static function setLogHistory(string $logHistory): self
    {
        self::$logHistory = $logHistory;

        return new self;
    }

    /**
     * Set log history location
     *
     * @param string $logHistoryLocation log history location
     * @return self
     */
    public static function setLogHistoryLocation(string $logHistoryLocation): self
    {
        self::$logHistoryLocation = $logHistoryLocation;

        return new self;
    }

    /**
     * Set limit history days
     *
     * @param integer $limitDays limit history days
     * @return self
     */
    public static function setLimitDays(int $limitDays): self
    {
        self::$limitDays = $limitDays;

        return new self;
    }
}
