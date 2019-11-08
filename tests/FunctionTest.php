<?php


namespace Caner\Stickware\Tests;

use Caner\Stickware\Tests\Stubs\Models\User;
use Carbon\Carbon;

class FunctionTest extends TestCase
{
    /** @test */
    public function add_point_test()
    {
        $user = User::first();

        $this->assertEquals(0, $user->getTotalPoint());

        $user->addPoint(100, 'add_blog_post');
        $this->assertEquals(100, $user->getTotalPoint());
    }

    /** @test */
    public function add_points_for_reason_test()
    {
        $user = User::first();

        $user->addPoint(20, 'add_comment');
        $this->assertEquals(20, $user->totalPointForReason('add_comment'));
    }

    /** @test */
    public function total_points_today_test()
    {
        $user = User::first();

        $user->addPoint(20, 'add_comment');
        $this->assertEquals(20, $user->totalPointsToday());
    }

    /** @test */
    public function user_points_yesterday_test()
    {
        $user = User::first();

        /*  Yesterday Date */
        $nowDate = Carbon::now()->subDay();
        Carbon::setTestNow($nowDate);

        $user->addPoint(20, 'add_comment');

        /* Now Date */
        Carbon::setTestNow();

        $this->assertEquals(20, $user->totalPointsYesterday());
    }

    /** @test */
    public function total_points_in_days_test()
    {
        $user = User::first();

        /*  Yesterday Date */
        $nowDate = Carbon::now()->subDay();
        Carbon::setTestNow($nowDate);

        $user->addPoint(20, 'add_comment');

        /* 5 Days Ago */
        $nowDate->subDays(4);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* 10 Days Ago */
        $nowDate->subDays(5);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');
        $user->addPoint(20, 'add_comment');

        /* Now Date */
        Carbon::setTestNow();

        $this->assertEquals(20, $user->totalPointsInDays(3));
        $this->assertEquals(120, $user->totalPointsInDays(7));
        $this->assertEquals(240, $user->totalPointsInDays(15));
    }

    /** @test */
    public function total_points_this_week_test()
    {
        $user = User::first();

        /*  Yesterday Date + 5 Hours */
        $nowDate = Carbon::now()->startOfWeek()->addHour(5);
        Carbon::setTestNow($nowDate);

        $user->addPoint(20, 'add_comment');

        /* Week Start + 2 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Week Start + 4 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Week Start - 2 Days */
        Carbon::setTestNow();
        $nowDate = Carbon::now()->startOfWeek()->subDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');
        $user->addPoint(20, 'add_comment');

        /* Real Now Date */
        Carbon::setTestNow();

        $this->assertEquals(220, $user->totalPointsThisWeek());
    }

    /** @test */
    public function total_points_last_week_test () {
        $user = User::first();

        /*  Yesterday Date + 5 Hours */
        $nowDate = Carbon::now()->startOfWeek()->addHour(5);
        Carbon::setTestNow($nowDate);

        $user->addPoint(20, 'add_comment');

        /* Week Start + 2 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Week Start + 4 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Week Start - 2 Days */
        Carbon::setTestNow();
        $nowDate = Carbon::now()->startOfWeek()->subDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');
        $user->addPoint(20, 'add_comment');

        /* Real Now Date */
        Carbon::setTestNow();

        $this->assertEquals(120, $user->totalPointsLastWeek());
    }

    /** @test */
    public function total_points_this_month_test () {
        $user = User::first();

        /*  Month Start Date + 5 Hours */
        $nowDate = Carbon::now()->startOfMonth()->addHour(5);
        Carbon::setTestNow($nowDate);

        $user->addPoint(20, 'add_comment');

        /* Month Start + 2 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Month Start + 4 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Month Start - 2 Days */
        Carbon::setTestNow();
        $nowDate = Carbon::now()->startOfMonth()->subDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');
        $user->addPoint(20, 'add_comment');

        /* Real Now Date */
        Carbon::setTestNow();

        $this->assertEquals(220, $user->totalPointsThisMonth());
    }

    /** @test */
    public function total_points_last_month_test () {
        $user = User::first();

        /*  Month Start Date + 5 Hours */
        $nowDate = Carbon::now()->startOfMonth()->addHour(5);
        Carbon::setTestNow($nowDate);

        $user->addPoint(20, 'add_comment');

        /* Month Start + 2 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Month Start + 4 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Month Start - 2 Days */
        Carbon::setTestNow();
        $nowDate = Carbon::now()->startOfMonth()->subDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');
        $user->addPoint(20, 'add_comment');

        /* Real Now Date */
        Carbon::setTestNow();

        $this->assertEquals(120, $user->totalPointsLastMonth());
    }

    /** @test */
    public function total_points_this_year_test () {
        $user = User::first();

        /*  Year Start Date + 5 Hours */
        $nowDate = Carbon::now()->startOfYear()->addHour(5);
        Carbon::setTestNow($nowDate);

        $user->addPoint(20, 'add_comment');

        /* Year Start + 2 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Year Start + 4 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Year Start - 2 Days */
        Carbon::setTestNow();
        $nowDate = Carbon::now()->startOfYear()->subDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');
        $user->addPoint(20, 'add_comment');

        /* Real Now Date */
        Carbon::setTestNow();

        $this->assertEquals(220, $user->totalPointsThisYear());
    }

    /** @test */
    public function total_points_last_year_test () {
        $user = User::first();

        /*  Year Start Date + 5 Hours */
        $nowDate = Carbon::now()->startOfYear()->addHour(5);
        Carbon::setTestNow($nowDate);

        $user->addPoint(20, 'add_comment');

        /* Year Start + 2 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Year Start + 4 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Year Start - 2 Days */
        Carbon::setTestNow();
        $nowDate = Carbon::now()->startOfYear()->subDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');
        $user->addPoint(20, 'add_comment');

        /* Real Now Date */
        Carbon::setTestNow();

        $this->assertEquals(120, $user->totalPointsLastYear());
    }

    /** @test */
    public function total_point_for_reason_test()
    {
        $user = User::first();

        /*  Year Start Date + 5 Hours */
        $nowDate = Carbon::now()->startOfYear()->addHour(5);
        Carbon::setTestNow($nowDate);

        $user->addPoint(20, 'add_comment');

        /* Year Start + 2 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Year Start + 4 Days + 5 Hours */
        $nowDate->addDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');

        /* Year Start - 2 Days */
        Carbon::setTestNow();
        $nowDate = Carbon::now()->startOfYear()->subDays(2);
        Carbon::setTestNow($nowDate);

        $user->addPoint(100, 'add_post');
        $user->addPoint(20, 'add_comment');

        /* Real Now Date */
        Carbon::setTestNow();

        $this->assertEquals(300, $user->totalPointForReason('add_post'));
        $this->assertEquals(40, $user->totalPointForReason('add_comment'));
    }
}