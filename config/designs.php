<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Public site designs
|--------------------------------------------------------------------------
|
| The design visitors see is chosen in the admin panel (Appearance page) and
| stored in the database. `default` is used until one has been chosen.
|
| Each design can add copy to the shared `profile` prop: its `profile` array
| is merged on top of config/profile.php when that design is active. The
| same PROFILE_* environment variable means the same thing in every design;
| only the defaults differ.
|
| PLACEHOLDERS: values written in [SQUARE BRACKETS] are placeholders for the
| site owner to fill in. Blueprint renders them in a visibly "draft" style.
|
*/
return [
    'default' => env('SITE_DESIGN', 'source'),

    'designs' => [
        'source' => [
            'profile' => [
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
            ],
        ],

        'bento' => [
            'profile' => [
                // Home page introduction. The defaults are taken from the copy of the previous About page.
                'headline' => env('PROFILE_HEADLINE', 'Full-stack developer who loves taking ideas to reality.'),
                'bio' => env('PROFILE_BIO', 'Proficient in both back-end and front-end development, including REST and MVC-based frameworks. Responsible, independent, and committed to lifelong learning.'),

                // Final grade of the main degree, shown as the big figure of the education card (e.g. "95%").
                // Empty: the card shows the graduation year instead.
                'education_score' => env('PROFILE_EDUCATION_SCORE'),
            ],
        ],

        'terrain' => [
            'profile' => [
                // Short introduction for the home page hero. The headline follows "I'm <first name>, ".
                'headline' => env('PROFILE_HEADLINE', 'a full-stack developer who loves taking ideas to reality.'),
                'bio' => env('PROFILE_BIO', 'Proficient in both back-end and front-end development, including REST and MVC-based frameworks. Responsible, independent and always happy to learn something new.'),
            ],
        ],

        'kinetic' => [
            'profile' => [
                // Short introduction under the name on the home page.
                'bio' => env('PROFILE_BIO', 'Tech Lead and full-stack developer based in Tel Aviv, Israel.'),

                // One-line introductions under each page title. Leave one empty to hide it.
                'intros' => [
                    'experience' => env('PROFILE_INTRO_EXPERIENCE', 'Work history, education, certifications and awards.'),
                    'portfolio' => env('PROFILE_INTRO_PORTFOLIO', 'Selected projects, grouped by category.'),
                    'soft_skills' => env('PROFILE_INTRO_SOFT_SKILLS', 'How I work with people and on projects.'),
                    'hobbies' => env('PROFILE_INTRO_HOBBIES', 'What I do away from the keyboard.'),
                ],
            ],
        ],

        // Copy for the leadership design. In any string, `:team_size` is replaced with current_role.team_size.
        'blueprint' => [
            'profile' => [
                'current_role' => [
                    'company' => env('PROFILE_CURRENT_COMPANY', '[CURRENT COMPANY]'),
                    // "YYYY-MM" (shown as "Mar 2023"), or any free text.
                    'since' => env('PROFILE_CURRENT_SINCE', '[START DATE]'),
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
            ],
        ],
    ],
];
