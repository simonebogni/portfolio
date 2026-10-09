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
| Copy that has no database source (intro, ways of working, ...) lives here
| too. In any string, `:team_size` is replaced with current_role.team_size.
|
| PLACEHOLDERS: values written in [SQUARE BRACKETS] are placeholders for the
| site owner to fill in. The front end renders them in a visibly "draft"
| style, so they are easy to spot. See docs/design-system.md.
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
        'company' => env('PROFILE_CURRENT_COMPANY', '[CURRENT COMPANY]'),
        // "YYYY-MM" (shown as "Mar 2023"), or any free text.
        'since' => env('PROFILE_CURRENT_SINCE', '[START DATE]'),
        'team_size' => (int) env('PROFILE_TEAM_SIZE', 15),
        'summary' => env(
            'PROFILE_CURRENT_SUMMARY',
            "I lead a team of :team_size developers and work directly with our customers' designers and product managers: shaping requirements, setting technical direction and staying hands-on in the code.",
        ),
        'outcomes' => [
            '[2–3 OUTCOMES: e.g. a launch, a platform migration, how the team grew]',
        ],
        'partners' => 'Customer designers & product managers',
        'focus' => 'Technical direction, planning, delivery, mentoring',
        'hands_on' => 'Full-stack development · Shopify',
    ],

    'availability' => env('PROFILE_AVAILABILITY'),

    // Home page headline. Wrap words in *asterisks* to highlight them.
    'headline' => env(
        'PROFILE_HEADLINE',
        'I lead a team of *:team_size developers* and build products side by side with designers and product managers.',
    ),

    // Short bio under the home page headline.
    'intro' => env(
        'PROFILE_INTRO',
        "A hands-on full-stack developer and Shopify expert, working directly with customers' design and product teams: turning ideas into software that ships, and growing the engineers who build it.",
    ),

    // Heading of the contact band at the bottom of every page.
    'contact_prompt' => env('PROFILE_CONTACT_PROMPT', 'Need a Tech Lead who can talk to designers, PMs and developers alike?'),

    // Intros under each page title.
    'page_intros' => [
        'experience' => 'Automating business processes, building full-stack web platforms, and now leading engineers while partnering with customers\' design and product teams.',
        'portfolio' => 'Each project shows what it is, what it was built with and where to see it.',
        'soft_skills' => 'Code is a team sport. This is how I bring customers\' designers, product managers and my team of developers together, and the habits behind it.',
        'hobbies' => 'What I do when the laptop is closed, and what it teaches me about working with people.',
    ],

    // The "How I work" diagram on the home page: who the lead sits between.
    'collaboration' => [
        'partners' => [
            ['name' => 'Customer designers', 'focus' => 'UX, UI, design systems'],
            ['name' => 'Product managers', 'focus' => 'Goals, scope, priorities'],
        ],
        'lead_focus' => 'Architecture, planning, hands-on code',
    ],

    // "What I bring" cards on the home page. Icons: team, partnership, code.
    'strengths' => [
        [
            'icon' => 'team',
            'title' => 'Technical leadership',
            'text' => 'Leading a team of :team_size developers: technical direction, planning and delivery, and helping every engineer grow.',
        ],
        [
            'icon' => 'partnership',
            'title' => 'Product partnership',
            'text' => "Working directly with customers' designers and product managers, so what we build matches what they need, from the first idea to the release.",
        ],
        [
            'icon' => 'code',
            'title' => 'Hands-on engineering',
            'text' => 'Still writing code: full-stack across back end and front end, REST APIs and MVC frameworks, and Shopify.',
        ],
    ],

    // "From idea to release" steps on the soft skills page.
    'working_model' => [
        [
            'phase' => 'Discover',
            'title' => 'Understand the need',
            'text' => 'Sit with designers and product managers to understand the users, the goals and the constraints.',
            'people' => ['Design', 'Product'],
        ],
        [
            'phase' => 'Shape',
            'title' => 'Turn it into a plan',
            'text' => 'Translate designs and requirements into architecture, scope and a delivery plan the team believes in.',
            'people' => ['Product', 'Engineering'],
        ],
        [
            'phase' => 'Build',
            'title' => 'Deliver with the team',
            'text' => 'Guide :team_size developers through delivery: reviewing, unblocking and staying hands-on in the code.',
            'people' => ['Engineering'],
        ],
        [
            'phase' => 'Review',
            'title' => 'Ship, learn, grow',
            'text' => 'Release, review the result with design and product, and help every engineer grow from it.',
            'people' => ['Design', 'Product', 'Engineering'],
        ],
    ],

    // Groups for the soft skills (matched by name). Skills not listed go to "More".
    'soft_skill_groups' => [
        'Leadership' => ['Responsible', 'Able to self-manage', 'Good problem solver'],
        'Collaboration' => ['Team player', 'Open-minded', 'Flexible'],
        'Craft' => ['Lifelong learner', 'Adaptable'],
    ],

    // Extra notes for the hobby cards (matched by hobby title). Both keys are optional.
    'hobby_notes' => [
        'Host D&D games' => ['kind' => 'Tabletop RPG', 'lesson' => 'Creative problem solving, teamwork and collaboration.'],
        'Travelling' => ['kind' => 'Travel', 'lesson' => 'Working across cultures and languages.'],
        'Cooking (and eating!)' => ['kind' => 'Kitchen', 'lesson' => 'Iterate, taste, adjust: the same loop as good product work.'],
    ],

    // A leadership case study shown first on the portfolio page. Set 'title' to null to hide it.
    'featured_case_study' => [
        'title' => '[LEADERSHIP CASE STUDY TITLE]',
        'summary' => '[A project you led with a customer\'s designers and product managers: the problem, how the team of :team_size was organised, the decisions you made and the result.]',
        'stack' => '[STACK]',
        'outcome' => '[MEASURABLE RESULT]',
        'url' => null,
    ],
];
