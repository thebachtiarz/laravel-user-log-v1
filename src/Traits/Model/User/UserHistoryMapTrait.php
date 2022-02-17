<?php

namespace TheBachtiarz\UserLog\Traits\Model\User;

use TheBachtiarz\Toolkit\Helper\App\Converter\ConverterHelper;
use TheBachtiarz\UserLog\Traits\Model\ModelMapTrait;

/**
 * User History Map Trait
 */
trait UserHistoryMapTrait
{
    use ModelMapTrait, ConverterHelper;

    /**
     * user history simple list map
     *
     * @return array
     */
    public function simpleListMap(): array
    {
        return [
            'log_type' => self::humanLogTypeName($this->logmanager->name_type),
            'log_info' => $this->history,
            'datetime' => [
                'date' => self::humanDateTime($this->created_at, 'date'),
                'time' => self::humanDateTime($this->created_at, 'time')
            ]
        ] + $this->locationResolver() + $this->getId() + $this->getTimestamps();
    }

    /**
     * location history resolver
     *
     * @return array
     */
    private function locationResolver(): array
    {
        return $this->historylocation
            ? $this->historylocation->simpleListMap()
            : ['location' => null];
    }
}
