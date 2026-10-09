<?php

declare(strict_types=1);

namespace App\Filament\Resources\Certificates\Pages;

use App\Filament\Resources\Certificates\CertificateResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCertificate extends CreateRecord
{
    #[\Override]
    protected static string $resource = CertificateResource::class;
}
