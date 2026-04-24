<?php

use App\Models\Item;

// No need to repeat uses() here if Pest.php already sets it up for 'Feature'

test('can list all items', function () {
    // Arrange
    $items = Item::factory()->count(3)->create();

    // Act
    $response = $this->getJson(route('items.index'));

    // Assert
    $response->assertOk()
             ->assertJsonCount(3);
});

test('can create a new item', function () {
    // Arrange
    $data = Item::factory()->make()->toArray();

    // Act
    $response = $this->postJson(route('items.store'), $data);

    // Assert
    $response->assertCreated()
             ->assertJsonPath('title', $data['title']);
    $this->assertDatabaseHas('items', ['title' => $data['title']]);
});

test('can show a single item', function () {
    // Arrange
    $item = Item::factory()->create();

    // Act
    $response = $this->getJson(route('items.show', $item->id));

    // Assert
    $response->assertOk()
             ->assertJsonPath('id', $item->id);
});

test('can update an item', function () {
    // Arrange
    $item = Item::factory()->create(['title' => 'Old Title']);
    $updateData = ['title' => 'New Title', 'price' => 99.99];

    // Act
    $response = $this->patchJson(route('items.update', $item->id), $updateData);

    // Assert
    $response->assertOk()
             ->assertJsonPath('title', 'New Title');
    $this->assertDatabaseHas('items', ['title' => 'New Title']);
});

test('can delete an item', function () {
    // Arrange
    $item = Item::factory()->create();

    // Act
    $response = $this->deleteJson(route('items.destroy', $item->id));

    // Assert
    $response->assertNoContent();
    $this->assertModelMissing($item);
});
