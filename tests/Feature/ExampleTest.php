<?php

test('the application redirects to dashboard', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('filament.app.pages.dashboard'));
});
