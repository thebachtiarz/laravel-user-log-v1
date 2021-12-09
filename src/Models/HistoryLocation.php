<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLocation extends Model
{
    use HasFactory;

    protected $fillable = ['user_history_id', 'location'];

    // ? Map

    // ? Scope

    // ? Relation
    public function userhistory()
    {
        return $this->belongsTo(UserHistory::class);
    }
}
