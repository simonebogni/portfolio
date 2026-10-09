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

    // Short introduction under the name on the home page.
    'bio' => env('PROFILE_BIO', 'Tech Lead and full-stack developer based in Tel Aviv, Israel.'),

    'email' => env('PROFILE_EMAIL'),
    'github_url' => env('PROFILE_GITHUB_URL', 'https://github.com/simonebogni'),
    'linkedin_url' => env('PROFILE_LINKEDIN_URL'),

    'current_role' => [
        'title' => env('PROFILE_CURRENT_TITLE', 'Tech Lead'),
        'company' => env('PROFILE_CURRENT_COMPANY'),
        'since' => env('PROFILE_CURRENT_SINCE'),
        'team_size' => (int) env('PROFILE_TEAM_SIZE', 15),
        // One or two sentences about the current role, shown on the Experience page when a company is set.
        'summary' => env('PROFILE_CURRENT_SUMMARY'),
    ],

    // One-line introductions under each page title. Leave one empty to hide it.
    'intros' => [
        'experience' => env('PROFILE_INTRO_EXPERIENCE', 'Work history, education, certifications and awards.'),
        'portfolio' => env('PROFILE_INTRO_PORTFOLIO', 'Selected projects, grouped by category.'),
        'soft_skills' => env('PROFILE_INTRO_SOFT_SKILLS', 'How I work with people and on projects.'),
        'hobbies' => env('PROFILE_INTRO_HOBBIES', 'What I do away from the keyboard.'),
    ],

    'availability' => env('PROFILE_AVAILABILITY'),
];
