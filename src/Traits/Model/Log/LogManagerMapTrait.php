<?php

namespace TheBachtiarz\UserLog\Traits\Model\Log;

use TheBachtiarz\UserLog\Traits\Model\ModelMapTrait;

/**
 * Log Manager Map Trait
 */
trait LogManagerMapTrait
{
    use ModelMapTrait;

    /**
     * log manager simple list map
     *
     * @return array
     */
    public function simpleListMap(): array
    {
        return [
            'log_type' => $this->name_type,
            'log_code' => $this->alt_code,
            'log_info' => $this->description
        ] + $this->getId() + $this->getTimestamps();
    }
}
