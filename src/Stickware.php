<?php
namespace Caner\Stickware;

use Illuminate\Database\Eloquent\Model;

class Stickware extends Model
{

    public static function totalPointForReason(string $reason): int
    {
        return Stickware::where('reason',$reason)->sum('pointCount');
    }

}
