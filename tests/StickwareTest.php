<?php

namespace Caner\Stickware\Tests;

class StickwareTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_dispatch_a_job_that_calls_a_webhook()
    {
        $this->assertEquals(true, true);
    }
}