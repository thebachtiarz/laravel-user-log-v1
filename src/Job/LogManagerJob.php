<?php

namespace TheBachtiarz\UserLog\Job;

use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;
use TheBachtiarz\UserLog\Models\LogManager;

class LogManagerJob
{
    use ErrorLogTrait;

    /**
     * Model Log Manager data
     *
     * @var LogManager
     */
    protected static LogManager $logManager;

    /**
     * log name type
     *
     * @var string
     */
    protected static string $logNameType;

    /**
     * log alternative code
     *
     * @var string
     */
    protected static string $logAltCode;

    /**
     * log information
     *
     * @var string
     */
    protected static string $logInformation;

    // ? Public Methods
    /**
     * create new log manager
     *
     * @param boolean $map
     * @return array
     */
    public static function create(bool $map = false): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            $_create = LogManager::create([
                'name_type' => self::$logNameType,
                'alt_code' => self::$logAltCode,
                'description' => self::$logInformation
            ]);

            throw_if(!$_create, 'Exception', "Failed to create new log manager");

            $result['data'] = $map ? $_create->simpleListMap() : $_create;
            $result['status'] = true;
            $result['message'] = "Successfully create new log manager";
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();

            self::logCatch($th);
        } finally {
            return $result;
        }
    }

    /**
     * update log manager data
     *
     * @param boolean $map
     * @return array
     */
    public static function update(bool $map = false): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            $_logManager = self::find();

            throw_if(!$_logManager['status'], 'Exception', $_logManager['message']);

            $_logManager = $_logManager['data'];

            $_update = $_logManager->update([
                'name_type' => self::$logNameType,
                'alt_code' => self::$logAltCode,
                'description' => self::$logInformation
            ]);

            throw_if(!$_update, 'Exception', "Failed to update log manager");

            $result['data'] = $map ? $_logManager->simpleListMap() : $_logManager;
            $result['status'] = true;
            $result['message'] = "Successfully";
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();

            self::logCatch($th);
        } finally {
            return $result;
        }
    }

    /**
     * get all log manager data
     *
     * @param boolean $map
     * @return array
     */
    public static function getAll(bool $map = false): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            $_logManagers = LogManager::all();

            throw_if(!count($_logManagers), 'Exception', "There is no log manager data");

            $result['data'] = $map ? $_logManagers->map->simpleListMap() : $_logManagers;
            $result['status'] = true;
            $result['message'] = "List of log manager data";
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();

            self::logCatch($th);
        } finally {
            return $result;
        }
    }
    /**
     * find log manager by code
     *
     * @param boolean $map
     * @return array
     */
    public static function find(bool $map = false): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            $_logManager = LogManager::getByCode(self::$logAltCode)->first();

            throw_if(!$_logManager, 'Exception', "Log manager data not found");

            $result['data'] = $map ? $_logManager->simpleListMap() : $_logManager;
            $result['status'] = true;
            $result['message'] = "Log manager detail";
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();

            self::logCatch($th);
        } finally {
            return $result;
        }
    }

    // ? Private Methods

    // ? Setter Modules
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
     * Set log name type
     *
     * @param string $logNameType log name type
     * @return self
     */
    public static function setLogNameType(string $logNameType): self
    {
        self::$logNameType = $logNameType;

        return new self;
    }

    /**
     * Set log alternative code
     *
     * @param string $logAltCode log alternative code
     * @return self
     */
    public static function setLogAltCode(string $logAltCode): self
    {
        self::$logAltCode = $logAltCode;

        return new self;
    }

    /**
     * Set log information
     *
     * @param string $logInformation log information
     * @return self
     */
    public static function setLogInformation(string $logInformation): self
    {
        self::$logInformation = $logInformation;

        return new self;
    }
}
