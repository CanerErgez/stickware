<?php

namespace Caner\Stickware\Traits;

use Caner\Stickware\Models\StickwareUserPoint;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait UserPointTrait
{
    /**
     * @return MorphMany|StickwareUserPoint
     */
    public function userPoints()
    {
        return $this->morphMany(StickwareUserPoint::class, 'model');
    }


    public function addPoint(int $points, string $reason = null)
    {
        $point = $this->userPoints()->create([
            'points' => $points,
            'reason' => $reason,
        ]);

        return $point;
    }

    public function getTotalPoint(): int
    {
        return $this->userPoints()->sum('points');
    }

    public function totalPointsRange($startDate, $endDate): int
    {
        return $this->userPoints()->period($startDate, $endDate)->sum('points');
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
        $startDate = Carbon::now()->subdays($dayCount);

        return $this->totalPointsRange($startDate, Carbon::now());
    }

    public function totalPointsThisWeek(): int
    {
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek();
        $now = Carbon::now();
        $weekEndDate = $now->endOfWeek();

        return $this->totalPointsRange($weekStartDate, $weekEndDate);
    }

    public function totalPointsLastWeek(): int
    {
        $now = Carbon::now()->subDays(7);
        $weekStartDate = $now->startOfWeek();
        $now = Carbon::now()->subDays(7);
        $weekEndDate = $now->endOfWeek();

        return $this->totalPointsRange($weekStartDate, $weekEndDate);
    }

    public function totalPointsThisMonth(): int
    {
        $now = Carbon::now();
        $monthStartDate = $now->startOfMonth();
        $now = Carbon::now();
        $monthEndDate = $now->endOfMonth();

        return $this->totalPointsRange($monthStartDate, $monthEndDate);
    }

    public function totalPointsLastMonth(): int
    {
        $now = Carbon::now()->subMonth();
        $monthStartDate = $now->startOfMonth();
        $now = Carbon::now()->subMonth();
        $monthEndDate = $now->endOfMonth();

        return $this->totalPointsRange($monthStartDate, $monthEndDate);
    }

    public function totalPointsThisYear(): int
    {
        $now = Carbon::now();
        $yearStartDate = $now->startOfYear();
        $now = Carbon::now();
        $yearEndDate = $now->endOfYear();

        return $this->totalPointsRange($yearStartDate, $yearEndDate);
    }

    public function totalPointsLastYear(): int
    {
        $now = Carbon::now();
        $yearStartDate = $now->subYear()->startOfYear();
        $now = Carbon::now();
        $yearEndDate = $now->subYear()->endOfYear();

        return $this->totalPointsRange($yearStartDate, $yearEndDate);
    }

    public function totalPointForReason(string $reason): int
    {
        return $this->userPoints()->where('reason', $reason)->sum('points');
    }
    /*
        public function lastDayUserPointForReason(int $userId, string $reason, int $dayCount): int
        {
            $startDate = Carbon::now()->subdays($dayCount);

            return Stickware::where('userId', $userId)->where('reason', $reason)->whereBetween('created_at', [$startDate, Carbon::now()])->sum('points');
        }
    */
}
