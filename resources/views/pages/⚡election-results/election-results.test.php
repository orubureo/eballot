<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::election-result')
        ->assertStatus(200);
});
