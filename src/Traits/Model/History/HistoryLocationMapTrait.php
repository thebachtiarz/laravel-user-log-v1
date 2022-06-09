<?php

namespace TheBachtiarz\UserLog\Traits\Model\History;

use TheBachtiarz\Toolkit\Helper\App\Converter\ArrayHelper;
use TheBachtiarz\Toolkit\Helper\Model\ModelMapTrait;

/**
 * History Location Map Trait
 */
trait HistoryLocationMapTrait
{
    use ModelMapTrait, ArrayHelper;

    /**
     * History location simple list map
     *
     * @return array
     */
    public function simpleListMap(): array
    {
        return [
            'location' => $this->location ? self::jsonDecode($this->location) : null
        ] + $this->getId() + $this->getTimestamps();
    }
}
