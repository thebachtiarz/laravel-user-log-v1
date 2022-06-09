<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use TheBachtiarz\Auth\Model\User;
use TheBachtiarz\UserLog\Traits\Model\User\{UserHistoryMapTrait, UserHistoryScopeTrait};

class UserHistory extends Model
{
    use UserHistoryMapTrait, UserHistoryScopeTrait;

    protected $fillable = ['user_id', 'log_manager_id', 'history'];

    // ? Relation
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logmanager(): BelongsTo
    {
        return $this->belongsTo(LogManager::class, 'log_manager_id');
    }

    public function historylocation(): HasOne
    {
        return $this->hasOne(HistoryLocation::class);
    }
}
