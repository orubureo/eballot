<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::elections')
        ->assertStatus(200);
});
