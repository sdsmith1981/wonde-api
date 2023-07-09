<?php

use App\Models\User;

test('the timetable index', function () {

    $client = Mockery::mock(\Wonde\Client::class);
    $client->shouldReceive('schools->all');

    $this->actingAs($user = User::factory()->create());
    $response = $this->get('/dashboard');
    $response->assertStatus(200);
    $response->assertSee('timetable');
});

test('the timetable show', function () {
    $this->actingAs($user = User::factory()->create());
    $response = $this->get('/timetable');
    $response->assertStatus(302);

    $response = $this->get('/timetable?teacher=A1479200480'); //normally i'd fake this
    $response->assertStatus(200);
    $response->assertJsonIsObject();
});
