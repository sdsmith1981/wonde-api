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


// using pest write a test for TimetableController::show that:
// - asserts that the route exists
// - asserts that the route is protected by auth
// - asserts that the route returns a 200 status code
// - asserts that the route requires a teacher_id parameter
// - asserts that the route returns a json response



test('the timetable show', function () {
    $this->actingAs($user = User::factory()->create());
    $response = $this->get('/timetable');
    $response->assertStatus(302);

    $response = $this->get('/timetable?teacher=A1479200480'); //normally i'd fake this
    $response->assertStatus(200);
    $response->assertJsonIsObject();
});
