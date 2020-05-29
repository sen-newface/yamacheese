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

    /**
     * update
     */

    /**
     * @testdox イベントのデータが更新出来る。
     */
    public function testSuccessUpdate()
    {
        $event = factory(Event::class)->create();

        $response = $this->putJson('/api/events/' . $event->id, [
            'name' => 'ceremony',
            'start_at' => '2019-05-05',
            'end_at' => '2020-05-05',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('events', [
            'name' => 'ceremony',
            'start_at' => '2019-05-05',
            'end_at' => '2020-05-05',
            'authorization_key' => '11111111',
            'user_id' => 1
        ]);
        $response->assertJson([
            'name' => 'ceremony',
            'start_at' => '2019-05-05',
            'end_at' => '2020-05-05',
            'authorization_key' => '11111111',
            'user_id' => 1
        ]);
    }
}
