<?php

namespace Caner\Stickware\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 *
 * @property int points
 * @property string reason
 * @method static Builder|StickwareUserPoint period($since, $to)
 */
class StickwareUserPoint extends Model
{
    /**
     * The table containing the users.
     *
     * @var string
     */
    protected $table = 'stickware_user_point';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['points', 'reason'];

    /**
     * @param  string  $reason
     * @return int
     */
    public static function totalPointForReason(string $reason): int
    {
        return self::where('reason', $reason)->sum('points');
    }

    /**
     * @param  Builder|static  $query
     * @param  Carbon  $since
     * @param  Carbon  $to
     * @return Builder|static
     */
    public function scopePeriod($query, Carbon $since, Carbon $to)
    {
        return $query->whereBetween($this->getCreatedAtColumn(), [$since, $to]);
    }
}
