<?php


test('GET /generate-slug returns generated slug', function () {
    $title = 'Test Title!';
    $response = $this->getJson('/generate-slug?title=' . urlencode($title));

    $response->assertStatus(200)
             ->assertJson(['slug' => generate_slug($title)]);
});

test('GET /generate-slug returns validation error', function () {
    $title = 'Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title!';
    $response = $this->getJson('/generate-slug?title=' . urlencode($title));

    $response->assertStatus(422)
             ->assertJsonValidationErrors('title');
});

test('GET /generate-slug returns required title error', function () {
    $title = 'Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title! Test Title!';
    $response = $this->getJson('/generate-slug');

    $response->assertStatus(422)
             ->assertJsonValidationErrors('title');
});


test('GET /generate-slug returns error when title is an array', function () {
    $response = $this->getJson('/generate-slug?title[]=test&title[]=array');

    $response->assertStatus(422)
             ->assertJsonValidationErrors('title');
});


test('POST /generate-slug is not allowed', function () {
    $response = $this->postJson('/generate-slug', ['title' => 'Test Title']);

    $response->assertStatus(405); 
});



