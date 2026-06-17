<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|View
    {
        $workExperiece = CompanyController::getCompanies();
        $education = [
            'priorityInstitutes' => InstituteController::getPriorityInstitutes(),
            'programsLowInstitutePriority' => ProgramController::getProgramsLowInstitutePriority(),
        ];
        $certifications = CertificateController::getCertificates();
        $awards = AwardController::getAwards();

        return view('experience', [
            'workExperience' => $workExperiece,
            'education' => $education,
            'certifications' => $certifications,
            'awards' => $awards,
        ]);
    }
}
