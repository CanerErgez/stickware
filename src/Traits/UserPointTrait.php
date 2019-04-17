<?php
namespace Stickware\Traits;

use Illuminate\Http\Request;
use Exception;
use Stickware\Models\StickwareUserPoint;
use App\User;
use Carbon\Carbon;

trait UserPointTrait
{
  public static function addPoint(int $userId, int $pointCount, string $reason): bool
  {
    self::handlePoinableTest($userId, $pointCount, $reason);

    $sup = new StickwareUserPoint();
    $sup->userId = $userId;
    $sup->pointCount = $pointCount;
    $sup->reason = $reason;

    if ($sup->save()) {
      return true;
    } else {
      throw new Exception('Ouch! Sorry . User Point Not Added. Please write me this error in Github for me.');
      return false;
    }
  }

  public static function TotalUserPoint(int $userId): int
  {
    self::validateUser($userId);

    $sum = StickwareUserPoint::where('userId',$userId)->sum('pointCount');

    return $sum;
  }

  public static function todayUserPoint(int $userId): int
  {
    self::validateUser($userId);

    $sum = StickwareUserPoint::where('userId',$userId)->whereBetween('created_at',[Carbon::today(),Carbon::now()])->sum('pointCount');

    return $sum;
  }

  public static function yesterdayUserPoint(int $userId): int
  {
    self::validateUser($userId);

    $sum = StickwareUserPoint::where('userId',$userId)->whereBetween('created_at',[Carbon::yesterday(),Carbon::today()])->sum('pointCount');

    return $sum;
  }

  public static function lastCustomDayUserPoint(int $userId, int $dayCount): int
  {
    self::validateUser($userId);

    $startDate = Carbon::now()->subdays($dayCount)->format('Y-m-d H:i:s');

    $sum = StickwareUserPoint::where('userId',$userId)->whereBetween('created_at',[$startDate,Carbon::now()])->sum('pointCount');

    return $sum;
  }

  public static function thisWeekUserPoint(int $userId): int
  {
    self::validateUser($userId);

    $now = Carbon::now();
    $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i:s');
    $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i:s');

    $sum = StickwareUserPoint::where('userId',$userId)->whereBetween('created_at',[$weekStartDate,$weekEndDate])->sum('pointCount');

    return $sum;
  }

  public static function lastWeekUserPoint(int $userId): int
  {
    self::validateUser($userId);

    $now = Carbon::now()->subDays(7);
    $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i:s');
    $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i:s');

    $sum = StickwareUserPoint::where('userId',$userId)->whereBetween('created_at',[$weekStartDate,$weekEndDate])->sum('pointCount');

    return $sum;
  }

  public static function thisMonthUserPoint(int $userId): int
  {
    self::validateUser($userId);

    $now = Carbon::now();
    $monthStartDate = $now->startOfMonth()->format('Y-m-d H:i:s');
    $monthEndDate = $now->endOfMonth()->format('Y-m-d H:i:s');

    $sum = StickwareUserPoint::where('userId',$userId)->whereBetween('created_at',[$monthStartDate,$monthEndDate])->sum('pointCount');

    return $sum;
  }

  public static function lastMonthUserPoint(int $userId): int
  {
    self::validateUser($userId);

    $now = Carbon::now()->subMonth();
    $monthStartDate = $now->startOfMonth()->format('Y-m-d H:i:s');
    $monthEndDate = $now->endOfMonth()->format('Y-m-d H:i:s');

    $sum = StickwareUserPoint::where('userId',$userId)->whereBetween('created_at',[$monthStartDate,$monthEndDate])->sum('pointCount');

    return $sum;
  }

  public static function thisYearUserPoint(int $userId): int
  {
    self::validateUser($userId);

    $now = Carbon::now();
    $yearStartDate = $now->startOfYear()->format('Y-m-d H:i:s');
    $yearEndDate = $now->endOfYear()->format('Y-m-d H:i:s');

    $sum = StickwareUserPoint::where('userId',$userId)->whereBetween('created_at',[$yearStartDate,$yearEndDate])->sum('pointCount');

    return $sum;
  }

  public static function lastYearUserPoint(int $userId): int
  {
    self::validateUser($userId);

    $now = Carbon::now();
    $yearStartDate = $now->subYear()->startOfYear()->format('Y-m-d H:i:s');
    $yearEndDate = $now->subYear()->endOfYear()->format('Y-m-d H:i:s');

    $sum = StickwareUserPoint::where('userId',$userId)->whereBetween('created_at',[$yearStartDate,$yearEndDate])->sum('pointCount');

    return $sum;
  }

  public static function totalPointForReason(string $reason): int
  {
    $sum = StickwareUserPoint::where('reason',$reason)->sum('pointCount');

    return $sum;
  }

  public static function userPointForReason(int $userId, string $reason): int
  {
    self::validateUser($userId);

    $sum = StickwareUserPoint::where('userId',$userId)->where('reason',$reason)->sum('pointCount');

    return $sum;
  }

  public static function lastDayUserPointForReason(int $userId, string $reason, int $dayCount): int
  {
    self::validateUser($userId);

    $startDate = Carbon::now()->subdays($dayCount)->format('Y-m-d H:i:s');

    $sum = StickwareUserPoint::where('userId',$userId)->where('reason',$reason)->whereBetween('created_at',[$startDate,Carbon::now()])->sum('pointCount');

    return $sum;
  }

  public static function handlePoinableTest(int $userId, int $pointCount, string $reason)
  {
    self::validateUser($userId);
    self::validatePoint($pointCount);
    self::validateReason($reason);
  }

  public static function validateUser(int $userId): bool
  {
    $user = User::find($userId);

    if (!$user) {
      throw new Exception('User not found in user table.');
    }

    return true;
  }

  public static function validatePoint(int $pointCount): bool
  {
    if (!is_integer($pointCount)) {
      throw new Exception('Point count must be integer.');
    }

    return true;
  }

  public static function validateReason(string $reason): bool
  {
    if (strlen($reason) > 190) {
      throw new Exception('Reason is smaller than 190 character.');
    }

    return true;
  }
}
