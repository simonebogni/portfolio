<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Support\Collection;

class CertificateController extends Controller
{
    /**
     * Return a collection of all the certificates
     */
    public static function getCertificates(): Collection
    {
        return Certificate::with('tags')->orderByDesc('issue_date')
            ->get();
    }
}
