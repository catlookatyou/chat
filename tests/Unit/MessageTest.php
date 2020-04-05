<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class MessageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPost()
    {
        $user = factory('App\User')->create();
        $user->room_id = 1;
        $user->save();
        $message = 'helloworld';

        $response = $this->actingAs($user)
        ->call('POST', 'post', [
            'message' => 'title 999',
            '_token' => csrf_token(), // 手動加入 _token
        ]);

        $response->assertStatus(201);

        //vendor/bin/phpunit
    }
}
