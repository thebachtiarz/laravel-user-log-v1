<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\Model;
use TheBachtiarz\UserLog\Traits\Model\History\{HistoryLocationMapTrait, HistoryLocationScopeTrait};

class HistoryLocation extends Model
{
    use HistoryLocationMapTrait, HistoryLocationScopeTrait;

    protected $fillable = ['user_history_id', 'location'];

    // ? Relation
    public function userhistory()
    {
        return $this->belongsTo(UserHistory::class);
    }
}
