<?php

namespace Caner\Stickware\Traits;

use Caner\Stickware\Models\StickwareUserPoint;
use Carbon\Carbon;

trait UserPointTrait
{

    public function userPoints()
    {
        return $this->morphMany(StickwareUserPoint::class, 'model');
    }

    public function addPoint(int $pointCount, string $reason = null)
    {
        $point = $this->userPoints()->create([
            'pointCount' => $pointCount,
            'reason' => $reason,
        ]);

        return $point;
    }

    public function totalPoints(): int
    {
        return $this->userPoints()->sum('pointCount');
    }

    public function totalPointsRange($startDate, $endDate): int
    {
        return $this->userPoints()->whereBetween('created_at', [$startDate, $endDate])->sum('pointCount');
    }

    public function totalPointsToday()
    {
        return $this->totalPointsRange(Carbon::today(), Carbon::now());
    }

    public function totalPointsYesterday()
    {
        return $this->totalPointsRange(Carbon::yesterday(), Carbon::today());
    }

    public function totalPointsInDays(int $dayCount): int
    {
        $startDate = Carbon::now()->subdays($dayCount)->format('Y-m-d H:i:s');

        return $this->totalPointsRange($startDate, Carbon::now());
    }

    public function totalPointsThisWeek(): int
    {
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i:s');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i:s');

        return $this->totalPointsRange($weekStartDate, $weekEndDate);
    }

    public function totalPointsLastWeek(): int
    {
        $now = Carbon::now()->subDays(7);
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i:s');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i:s');

        return $this->totalPointsRange($weekStartDate, $weekEndDate);
    }

    public function totalPointsThisMonth(): int
    {
        $now = Carbon::now();
        $monthStartDate = $now->startOfMonth()->format('Y-m-d H:i:s');
        $monthEndDate = $now->endOfMonth()->format('Y-m-d H:i:s');

        return $this->totalPointsRange($monthStartDate, $monthEndDate);
    }

    public function totalPointsLastMonth(): int
    {
        $now = Carbon::now()->subMonth();
        $monthStartDate = $now->startOfMonth()->format('Y-m-d H:i:s');
        $monthEndDate = $now->endOfMonth()->format('Y-m-d H:i:s');

        return $this->totalPointsRange($monthStartDate, $monthEndDate);
    }

    public function totalPointsThisYear(): int
    {
        $now = Carbon::now();
        $yearStartDate = $now->startOfYear()->format('Y-m-d H:i:s');
        $yearEndDate = $now->endOfYear()->format('Y-m-d H:i:s');

        return $this->totalPointsRange($yearStartDate, $yearEndDate);
    }

    public function totalPointsLastYear(): int
    {
        $now = Carbon::now();
        $yearStartDate = $now->subYear()->startOfYear()->format('Y-m-d H:i:s');
        $yearEndDate = $now->subYear()->endOfYear()->format('Y-m-d H:i:s');

        return $this->totalPointsRange($yearStartDate, $yearEndDate);
    }

    public function totalPointForReason(string $reason): int
    {
        return $this->userPoints()->where('reason', $reason)->sum('pointCount');
    }
    /*
        public function lastDayUserPointForReason(int $userId, string $reason, int $dayCount): int
        {
            self::validateUser($userId);

            $startDate = Carbon::now()->subdays($dayCount)->format('Y-m-d H:i:s');

            return Stickware::where('userId', $userId)->where('reason', $reason)->whereBetween('created_at', [$startDate, Carbon::now()])->sum('pointCount');
        }
    */
}
