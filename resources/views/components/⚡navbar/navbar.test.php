<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('navbar')
        ->assertStatus(200);
});
