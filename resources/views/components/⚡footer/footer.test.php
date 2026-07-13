<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('footer')
        ->assertStatus(200);
});
