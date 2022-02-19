<?php

namespace TheBachtiarz\UserLog\Services;

use TheBachtiarz\Toolkit\Helper\App\Response\DataResponse;
use TheBachtiarz\UserLog\Interfaces\Data\LogManagerDataInterface;
use TheBachtiarz\UserLog\Job\LogManagerJob;

class LogManagerService
{
    use DataResponse;

    /**
     * log name
     *
     * @var string
     */
    private static string $logName;

    /**
     * log code
     *
     * @var string
     */
    private static string $logCode;

    /**
     * log info
     *
     * @var string
     */
    private static string $logInfo;

    // ? Public Methods
    /**
     * create new log manager
     *
     * @return array
     */
    public static function create(): array
    {
        try {
            $_create = LogManagerJob::setLogNameType(self::$logName)
                ->setLogAltCode(self::$logCode)
                ->setLogInformation(self::$logInfo)
                ->create(true);

            throw_if(!$_create['status'], 'Exception', $_create['message']);

            return self::responseData($_create['data'], $_create['message'], 201);
        } catch (\Throwable $th) {
            return self::responseError($th);
        }
    }

    /**
     * update log manager
     *
     * @return array
     */
    public static function update(): array
    {
        try {
            $_update = LogManagerJob::setLogNameType(self::$logName)
                ->setLogAltCode(self::$logCode)
                ->setLogInformation(self::$logInfo)
                ->update(true);

            throw_if(!$_update['status'], 'Exception', $_update['message']);

            return self::responseData($_update['data'], $_update['message'], 201);
        } catch (\Throwable $th) {
            return self::responseError($th);
        }
    }

    /**
     * reset log manager by data
     *
     * @return array
     */
    public static function resetByData(): array
    {
        try {
            $_logManagerData = array_merge(
                LogManagerDataInterface::LOG_MANAGEMENT_DATA,
                tbuserlogconfig('log_data_management')
            );

            foreach ($_logManagerData as $key => $logManager) {
                $_logManagerMutation = LogManagerJob::setLogNameType($logManager['name_type'])
                    ->setLogAltCode($logManager['alt_code'])
                    ->setLogInformation($logManager['description']);

                /**
                 * find log manager data by code.
                 * if exist, then do update.
                 * if not, then do create.
                 */
                $_logManagerMutation->find()['status']
                    ? $_logManagerMutation->update()
                    : $_logManagerMutation->create();
            }

            return self::responseData([], "Successfully create or update log manager data", 201);
        } catch (\Throwable $th) {
            return self::responseError($th);
        }
    }

    // ? Private Methods

    // ? Setter Modules
    /**
     * Set log name
     *
     * @param string $logName log name
     * @return self
     */
    public static function setLogName(string $logName): self
    {
        self::$logName = $logName;

        return new self;
    }

    /**
     * Set log code
     *
     * @param string $logCode log code
     * @return self
     */
    public static function setLogCode(string $logCode): self
    {
        self::$logCode = $logCode;

        return new self;
    }

    /**
     * Set log info
     *
     * @param string $logInfo log info
     * @return self
     */
    public static function setLogInfo(string $logInfo): self
    {
        self::$logInfo = $logInfo;

        return new self;
    }
}
