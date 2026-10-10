import type { CurrentRole, Profile } from '@core/entities/profile';

/*
 * The Blueprint copy merged into the shared `profile` prop, from config/designs.php
 * (`designs.blueprint.profile`). Config copy may contain `:team_size`.
 */

/** The current role, with the details shown on the Experience page. */
export interface BlueprintCurrentRole extends CurrentRole {
    outcomes: string[];
    partners: string | null;
    focus: string | null;
    hands_on: string | null;
}

/** A partner the lead works with in the "How I work" diagram. */
export interface CollaborationPartner {
    name: string;
    focus: string;
}

export interface Collaboration {
    partners: CollaborationPartner[];
    lead_focus: string;
}

/** A "What I bring" card. Icons: team, partnership, code. */
export interface Strength {
    icon: string;
    title: string;
    text: string;
}

/** A step of the "From idea to release" working model. */
export interface WorkingStep {
    phase: string;
    title: string;
    text: string;
    people?: string[];
}

/** Extra notes for a hobby card, matched by hobby title. */
export interface HobbyNote {
    kind?: string;
    lesson?: string;
}

/** The leadership case study shown first on the portfolio page; a null title hides it. */
export interface FeaturedCaseStudyCopy {
    title: string | null;
    summary: string | null;
    stack: string | null;
    outcome: string | null;
    url: string | null;
}

export interface PageIntros {
    experience: string | null;
    portfolio: string | null;
    soft_skills: string | null;
    hobbies: string | null;
}

export interface BlueprintProfile extends Profile {
    current_role: BlueprintCurrentRole;
    /** Home page headline; *asterisks* mark the highlighted words. */
    headline: string;
    intro: string | null;
    /** Heading of the contact band in the footer. */
    contact_prompt: string | null;
    page_intros: PageIntros;
    collaboration: Collaboration;
    strengths: Strength[];
    working_model?: WorkingStep[];
    /** Soft skill names per group name; skills not listed go to "More". */
    soft_skill_groups?: Record<string, string[]>;
    hobby_notes?: Record<string, HobbyNote>;
    featured_case_study?: FeaturedCaseStudyCopy | null;
}
