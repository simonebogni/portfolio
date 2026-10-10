import type { Certificate } from '@core/entities/certificate';

/** The issuer when every certificate has the same one, else "Credentials". */
export function certificateIssuer(certificates: readonly Certificate[]): string {
    const issuers = [...new Set(certificates.map((certificate) => certificate.issuedBy).filter(Boolean))];

    return issuers.length === 1 && issuers[0] ? issuers[0] : 'Credentials';
}
