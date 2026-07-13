<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::onboarding')
        ->assertStatus(200);
});
