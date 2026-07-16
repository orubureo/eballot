<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::elections-details')
        ->assertStatus(200);
});
