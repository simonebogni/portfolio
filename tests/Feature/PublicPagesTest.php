<?php

test('public pages return a successful response', function (string $uri): void {
    $this->get($uri)->assertOk();
})->with([
    'home' => '/',
    'about' => '/about',
    'experience' => '/experience',
    'portfolio' => '/portfolio',
    'soft skills' => '/softskills',
    'hobbies' => '/hobbies',
]);

test('health check endpoint is available', function (): void {
    $this->get('/up')->assertOk();
});
