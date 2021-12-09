<?php

use TheBachtiarz\UserLog\UserLogInterface;

/**
 * thebachtiarz user log config
 *
 * @param string|null $keyName config key name | null will return all
 * @return mixed|null
 */
function tbuserlogconfig(?string $keyName = null)
{
    $configName = UserLogInterface::USERLOG_CONFIG_NAME;

    return iconv_strlen($keyName)
        ? config("{$configName}.{$keyName}")
        : config("{$configName}");
}
