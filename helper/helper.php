<?php

use TheBachtiarz\UserLog\UserLogInterface;

/**
 * TheBachtiarz user log config
 *
 * @param string|null $keyName config key name | null will return all
 * @return mixed
 */
function tbuserlogconfig(?string $keyName = null): mixed
{
    $configName = UserLogInterface::USERLOG_CONFIG_NAME;

    return iconv_strlen($keyName)
        ? config("{$configName}.{$keyName}")
        : config("{$configName}");
}
