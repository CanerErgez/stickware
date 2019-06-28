<?php

namespace Caner\Stickware\Tests;

use Caner\Stickware\Tests\Stubs\Models\User;

class StickwareTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_create_and_query_total_points()
    {
        /** @var User $user */
        $user = User::first();

        $this->assertEquals(0, $user->totalPoints());

        $user->addPoint(100, 'iap');
        $this->assertEquals(100, $user->totalPoints());


        $user->addPoint(20, 'login');
        $this->assertEquals(20, $user->totalPointForReason('login'));

        $this->assertEquals(120, $user->totalPointsToday());
    }
}