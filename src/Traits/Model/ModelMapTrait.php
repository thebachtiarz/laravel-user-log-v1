<?php

namespace TheBachtiarz\UserLog\Traits\Model;

use Illuminate\Support\Facades\Auth;
use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;

/**
 * Model Map Trait
 */
trait ModelMapTrait
{
    use CarbonHelper;

    /**
     * check is request from admin
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        try {
            $_auth = Auth::user();

            throw_if(!$_auth, 'Exception', "");

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * timestamps information map
     *
     * @return array
     */
    public function getTimestamps(): array
    {
        $result = array_merge(
            $this->createdAt(),
            $this->updatedAt()
        );

        try {
            return array_merge(
                $result,
                $this->deletedAt()
            );
        } catch (\Throwable $th) {
            return $result;
        }
    }

    /**
     * model id map.
     * only authorized
     *
     * @return array
     */
    public function getId(): array
    {
        return $this->isAdmin() ? ['model_id' => $this->id] : [];
    }

    /**
     * created at map
     *
     * @return array
     */
    public function createdAt(): array
    {
        return ['created' => self::humanDateTime($this->created_at)];
    }

    /**
     * updated at map
     *
     * @return array
     */
    public function updatedAt(): array
    {
        return [
            'updated' => self::humanDateTime($this->updated_at),
            'interval' => self::humanIntervalCreateUpdate($this->created_at, $this->updated_at)
        ];
    }

    /**
     * deleted at map
     *
     * @return array
     */
    public function deletedAt(): array
    {
        return ['deleted' => $this->deleted_at ? self::humanDateTime($this->deleted_at) : null];
    }
}
