<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Public profile
|--------------------------------------------------------------------------
|
| Personal details shown across the public site. They are shared with every
| Inertia page as the `profile` prop. Leave a value empty to hide the parts
| of the UI that depend on it.
|
*/
return [
    'name' => env('PROFILE_NAME', 'Simone Bogni'),
    'roles' => ['Tech Lead', 'Full-stack developer', 'Shopify expert'],
    'location' => env('PROFILE_LOCATION', 'Tel Aviv, Israel'),

    // Short introduction for the home page hero. The headline follows "I'm <first name>, ".
    'headline' => env('PROFILE_HEADLINE', 'a full-stack developer who loves taking ideas to reality.'),
    'bio' => env('PROFILE_BIO', 'Proficient in both back-end and front-end development, including REST and MVC-based frameworks. Responsible, independent and always happy to learn something new.'),

    'email' => env('PROFILE_EMAIL'),
    'github_url' => env('PROFILE_GITHUB_URL', 'https://github.com/simonebogni'),
    'linkedin_url' => env('PROFILE_LINKEDIN_URL'),

    'current_role' => [
        'title' => env('PROFILE_CURRENT_TITLE', 'Tech Lead'),
        'company' => env('PROFILE_CURRENT_COMPANY'),
        'since' => env('PROFILE_CURRENT_SINCE'),
        'team_size' => (int) env('PROFILE_TEAM_SIZE', 15),
        // One or two sentences about the current role, shown on the Experience page.
        'summary' => env('PROFILE_CURRENT_SUMMARY'),
    ],

    'availability' => env('PROFILE_AVAILABILITY'),
];
