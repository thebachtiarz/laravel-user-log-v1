<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\HasMany;
use TheBachtiarz\UserLog\Traits\Model\Log\{LogManagerMapTrait, LogManagerScopeTrait};

class LogManager extends Model
{
    use SoftDeletes;

    use LogManagerMapTrait, LogManagerScopeTrait;

    protected $fillable = ['name_type', 'alt_code', 'description'];

    // ? Relation
    public function userhistories(): HasMany
    {
        return $this->hasMany(UserHistory::class, 'log_manager_id');
    }
}
