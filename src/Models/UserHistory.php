<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\Model;
use TheBachtiarz\Auth\Model\User;
use TheBachtiarz\UserLog\Traits\Model\User\{UserHistoryMapTrait, UserHistoryScopeTrait};

class UserHistory extends Model
{
    use UserHistoryMapTrait, UserHistoryScopeTrait;

    protected $fillable = ['user_id', 'log_manager_id', 'history'];

    // ? Relation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logmanager()
    {
        return $this->belongsTo(LogManager::class, 'log_manager_id');
    }

    public function historylocation()
    {
        return $this->hasOne(HistoryLocation::class);
    }
}
