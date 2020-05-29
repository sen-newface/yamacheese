<?php

namespace Tests\Feature\Api;

use App\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * show
     */

    /**
     * @testdox 指定したidのイベントのデータが取得出来る。
     */
    public function testSuccessShow()
    {
        $event = factory(Event::class)->create();

        $ret = $this->get('/api/events/' . $event->id);
        $ret->assertSuccessful();
        $ret->assertJson([
            'name' => 'party',
            'start_at' => '2019-10-10',
            'end_at' => '2020-04-01',
            'authorization_key' => '11111111',
            'user_id' => 1
        ]);
    }
}
