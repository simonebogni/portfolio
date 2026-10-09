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

    'email' => env('PROFILE_EMAIL'),
    'github_url' => env('PROFILE_GITHUB_URL', 'https://github.com/simonebogni'),
    'linkedin_url' => env('PROFILE_LINKEDIN_URL'),

    'current_role' => [
        'title' => env('PROFILE_CURRENT_TITLE', 'Tech Lead'),
        'company' => env('PROFILE_CURRENT_COMPANY'),
        'since' => env('PROFILE_CURRENT_SINCE'),
        'team_size' => (int) env('PROFILE_TEAM_SIZE', 15),
    ],

    'availability' => env('PROFILE_AVAILABILITY'),

    // Short texts for the home page hero. Defaults are taken from the owner's original About page.
    'bio' => env('PROFILE_BIO', 'Proficient in both back-end and front-end development, including REST and MVC-based frameworks. I love the feeling of accomplishment that comes from bringing a product from an idea to reality.'),
    'tagline' => env('PROFILE_TAGLINE', 'Always happy for more opportunities to learn'),

    // One-sentence introductions under each page title. Leave empty to hide them.
    'intros' => [
        'experience' => env('PROFILE_INTRO_EXPERIENCE', 'Work history, education, certifications and awards, most recent first.'),
        'portfolio' => env('PROFILE_INTRO_PORTFOLIO', 'A selection of projects, grouped by category.'),
        'soft_skills' => env('PROFILE_INTRO_SOFT_SKILLS', 'How I approach work, teams and projects.'),
        'hobbies' => env('PROFILE_INTRO_HOBBIES', 'What I do when the laptop is closed.'),
    ],
];
