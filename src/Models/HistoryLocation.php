<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TheBachtiarz\UserLog\UserLogInterface;

class HistoryLocation extends Model
{
    use HasFactory;

    protected $fillable = ['user_history_id', 'location'];

    const AVAILABLE_POSITION_KEY = config(UserLogInterface::USERLOG_CONFIG_NAME . '.location_keys');

    // ? Map

    // ? Scope

    // ? Relation
    public function userhistory()
    {
        return $this->belongsTo(UserHistory::class);
    }
}
