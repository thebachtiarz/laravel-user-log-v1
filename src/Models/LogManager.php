<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;

class LogManager extends Model
{
    use HasFactory, SoftDeletes, CarbonHelper;

    protected $fillable = ['name_type', 'alt_code', 'description'];

    // ? Map
    public function simpleListMap()
    {
        return [
            'type' => $this->name_type,
            'code' => $this->alt_code,
            'description' => $this->description
        ];
    }

    public function simpleDetailMap()
    {
        return [
            'type' => $this->name_type,
            'code' => $this->alt_code,
            'description' => $this->description,
            'created' => self::humanDateTime($this->created_at),
            'updated' => self::humanIntervalCreateUpdate($this->created_at, $this->updated_at)
        ];
    }

    // ? scope
    public function scopeGetLogByCode($query, string $logCode)
    {
        return $query->where('alt_code', $logCode)->first();
    }

    // ? Relation
    public function userhistory()
    {
        return $this->hasMany(UserHistory::class, 'log_manager_id');
    }
}
