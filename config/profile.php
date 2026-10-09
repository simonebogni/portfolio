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
| Copy conventions (see docs/design-system.md):
| - `{team_size}`, `{title}`, `{company}` and `{location}` are replaced with
|   the values below, so numbers are never hard-coded in the copy.
| - `*text*` marks the words shown in the accent italic.
| - A value written in [SQUARE BRACKETS] is a placeholder for the owner to
|   fill in. The site shows it in a dashed "placeholder" style until then.
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
        // "YYYY-MM" or "YYYY-MM-DD".
        'since' => env('PROFILE_CURRENT_SINCE'),
        'team_size' => (int) env('PROFILE_TEAM_SIZE', 15),
        'summary' => env(
            'PROFILE_CURRENT_SUMMARY',
            "I lead a team of {team_size} developers and partner directly with our customers' designers and product managers, from requirements to release, while staying hands-on in the code.",
        ),
        // Outcomes of the current role, one sentence each.
        'highlights' => [
            '[Two or three outcomes you are proud of.]',
        ],
        // Short labels shown as chips under the current role.
        'scope' => ['Team of {team_size}', 'Design & product partnership', 'Technical direction', 'Shopify'],
    ],

    'availability' => env('PROFILE_AVAILABILITY'),

    /*
    | Page copy that has no database source.
    */
    'copy' => [
        'headline' => env('PROFILE_HEADLINE', 'Engineering leadership, with my hands *still on the code*.'),
        'intro' => env(
            'PROFILE_INTRO',
            "I lead a team of {team_size} developers and work directly with our customers' designers and product managers — turning their ideas into software that ships, and helping the people who build it grow.",
        ),
        'works_with' => env('PROFILE_WORKS_WITH', 'Customer designers & product managers'),
        'experience_intro' => env(
            'PROFILE_EXPERIENCE_INTRO',
            "From automating business processes, to full-stack web platforms, to leading a team of {team_size} developers alongside customers' designers and product managers.",
        ),
        'portfolio_intro' => env(
            'PROFILE_PORTFOLIO_INTRO',
            'Web applications, data projects and experiments, grouped by category. Filter the list, or open a project to see it live or read the source.',
        ),
        'contact_headline' => env('PROFILE_CONTACT_HEADLINE', 'Looking for a {title} who *still ships*?'),
    ],

    /*
    | "Three roles, one person" on the About page.
    */
    'leadership_roles' => [
        [
            'title' => 'The engineer',
            'text' => "Full-stack across back end and front end — REST APIs, MVC frameworks, responsive interfaces and Shopify. Leading the team hasn't stopped me writing code.",
        ],
        [
            'title' => 'The lead',
            'text' => 'I set technical direction and plan delivery for a team of {team_size} developers, and make sure every one of them has room to grow.',
        ],
        [
            'title' => 'The partner',
            'text' => "I work side by side with customers' designers and product managers, so what we build is what they actually need.",
        ],
    ],

    /*
    | "How I lead teams and projects" on the About page.
    */
    'principles' => [
        ['title' => 'Own it end to end', 'text' => 'From the initial analysis until the release — and after.'],
        ['title' => 'Design and code are one conversation', 'text' => 'Designers, product managers and engineers decide together, early.'],
        ['title' => 'Keep learning, keep teaching', 'text' => 'A lifelong learner, sharing what I learn with the team.'],
        ['title' => 'Welcome the better idea', 'text' => 'Open-minded and flexible: the best argument wins, not the loudest.'],
    ],

    /*
    | Testimonials on the About page. Replace the placeholders with real
    | quotes (with permission), or empty the list to hide the section.
    */
    'testimonials' => [
        [
            'quote' => "[QUOTE FROM A PRODUCT MANAGER YOU'VE WORKED WITH — one or two sentences about collaboration and delivery.]",
            'name' => '[NAME]',
            'role' => 'Product Manager, [COMPANY]',
        ],
        [
            'quote' => '[QUOTE FROM A DESIGNER — how you turned their designs into a product that matched the intent.]',
            'name' => '[NAME]',
            'role' => 'Product Designer, [COMPANY]',
        ],
    ],

    /*
    | Featured engagement at the top of the Portfolio page (current role).
    | Set `title` to null to hide it.
    */
    'featured_engagement' => [
        'title' => env('PROFILE_FEATURED_TITLE', '[ENGAGEMENT TITLE]'),
        'summary' => env(
            'PROFILE_FEATURED_SUMMARY',
            '[What the customer needed, how you worked with their designers and product managers, how you organised the team of {team_size}, and what shipped.]',
        ),
        'outcome' => env('PROFILE_FEATURED_OUTCOME', '[MEASURABLE RESULT]'),
        'url' => env('PROFILE_FEATURED_URL'),
    ],

    /*
    | Groups shown under each soft skill, keyed by the soft skill name.
    | Skills are listed in the order of their group; unlisted skills come last.
    */
    'soft_skill_groups' => [
        'Responsible' => 'Leadership',
        'Able to self-manage' => 'Leadership',
        'Team player' => 'Collaboration',
        'Open-minded' => 'Collaboration',
        'Flexible' => 'Collaboration',
        'Good problem solver' => 'Craft',
        'Lifelong learner' => 'Craft',
        'Adaptable' => 'Craft',
    ],

    // Soft skill whose description is quoted at the top of the Soft skills page.
    'soft_skill_quote' => env('PROFILE_SOFT_SKILL_QUOTE', 'Responsible'),
];
