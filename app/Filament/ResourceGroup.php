<?php

namespace App\Filament;

enum ResourceGroup: string
{
    case APP_MANAGEMENT = 'Application Management';
    case EDUCATION = 'Education';
    case PERSONAL = 'Personal';
    case PORTFOLIO = 'Portfolio';
    case SKILLS = 'Skills';
    case WORK_EXPERIENCE = 'Work Experience';
}
