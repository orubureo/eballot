<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::logout')
        ->assertStatus(200);
});
