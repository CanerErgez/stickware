# Stickware
Basic Laravel User Point and Badge System

# Milestones
Step 1 - First Release . User Point System # OK! <br>
Step 2 - UserPoint System Updates <br>
Step 3 - Second Release . Badge System <br>
Step 4 - Badge System Updates <br>
Step 5 - General System Updated <br>

# Install

```
$ php artisan make:auth
```

```
$ composer require caner/stickware
```

```
$ php artisan migrate
```

# Usage

```php
// addPoint($userId,$pointCount,$reason)
Stickware::addPoint(1,10,'add_post');
// return true


// TotalUserPoint($userId)
Stickware::TotalUserPoint(1);
// return 26 (or sample integer value)


// todayUserPoint($userId)
Stickware::todayUserPoint(1);
// return 26 (or sample integer value)


// thisWeekUserPoint($userId)
Stickware::thisWeekUserPoint(1);
// return 59 (or sample integer value)


// thisMonthUserPoint($userId)
Stickware::thisMonthUserPoint(1);
// return 59 (or sample integer value)


// thisYearUserPoint($userId)
Stickware::thisYearUserPoint(1);
// return 59 (or sample integer value)


// yesterdayUserPoint($userId)
Stickware::yesterdayUserPoint(1);
// return 26 (or sample integer value)


// lastWeekUserPoint($userId)
Stickware::lastWeekUserPoint(1);
// return 26 (or sample integer value)


// lastMonthUserPoint($userId)
Stickware::lastMonthUserPoint(1);
// return 26 (or sample integer value)


// lastYearUserPoint($userId)
Stickware::lastYearUserPoint(1);
// return 26 (or sample integer value)


// lastCustomDayUserPoint($userId,$dayCount)
Stickware::lastCustomDayUserPoint(1,60);
// return 58 (or sample integer value)


// totalPointForReason($reason)
Stickware::totalPointForReason('add_post');
// return 70 (or sample integer value)


// userPointForReason($userId,$reason)
Stickware::userPointForReason(1,'add_comment');
// return 60 (or sample integer value)


// lastDayUserPointForReason($userId,$reason,$dayCount)
Stickware::lastDayUserPointForReason(1,'add_comment',60);
// return 60 (or sample integer value)
```
