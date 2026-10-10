import type { Award } from '@core/entities/award';
import type { Certificate } from '@core/entities/certificate';
import type { Institute, Program } from '@core/entities/education';
import type { Company } from '@core/entities/work';

/** Props of the Experience page (ExperienceController). */
export interface ExperienceProps {
    companies: Company[];
    institutes: Institute[];
    otherPrograms: Program[];
    certificates: Certificate[];
    awards: Award[];
}
