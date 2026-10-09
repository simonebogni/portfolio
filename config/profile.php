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

/**
 * Splits a multi-paragraph value (paragraphs separated by a blank line) into a list of paragraphs.
 *
 * @return list<string>
 */
$paragraphs = static fn (mixed $value): array => array_values(array_filter(
    array_map(trim(...), preg_split('/\R\s*\R/', (string) $value) ?: []),
    static fn (string $paragraph): bool => $paragraph !== '',
));

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
        'summary' => env('PROFILE_CURRENT_SUMMARY'),
        'team_size' => (int) env('PROFILE_TEAM_SIZE', 15),
    ],

    'availability' => env('PROFILE_AVAILABILITY'),

    /*
    | Home page headline. Wrap words in *asterisks* to set them in the accent italic.
    */
    'headline' => env('PROFILE_HEADLINE', 'I love bringing a product from an *idea* to *reality*.'),

    /*
    | Home page introduction. In .env, use a quoted value and separate the
    | paragraphs with a blank line. The default is the text of the previous site.
    */
    'bio' => $paragraphs(env('PROFILE_BIO', <<<'TEXT'
        Hello, my name is Simone, a full-stack web developer, proficient in both back-end and front-end development, including REST and MVC-based frameworks.

        Responsible and independent, I can effectively self-manage during projects, as well as collaborate in a team environment.

        Open-minded and flexible, I am committed to lifelong learning with an autodidact approach, and I have completed several courses on platforms such as EdX, Coursera, Udacity, Udemy and freeCodeCamp.

        I hold a Bachelor's degree in Computer Science with a score of 95%, and I really love the feeling of accomplishment that comes from bringing a product from an idea to reality.
        TEXT)),

    /*
    | One-line introductions under the page titles. Leave one empty to hide it.
    */
    'intros' => [
        'experience' => env('PROFILE_INTRO_EXPERIENCE', 'Where I have worked and studied, and the certificates and awards along the way.'),
        'portfolio' => env('PROFILE_INTRO_PORTFOLIO', 'Projects grouped by category, with links to the live site or the source code when they are available.'),
        'soft_skills' => env('PROFILE_INTRO_SOFT_SKILLS', 'The way I like to work, on my own and with a team.'),
        'hobbies' => env('PROFILE_INTRO_HOBBIES', 'What I do when the laptop is closed.'),
    ],
];
