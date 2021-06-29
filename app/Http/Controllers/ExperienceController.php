<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workExperiece = CompanyController::getCompanies();
        $education = [
            'priorityInstitutes' => InstituteController::getPriorityInstitutes(),
            'programsLowInstitutePriority' => ProgramController::getProgramsLowInstitutePriority()
        ];
        $certifications = CertificateController::getCertificates();
        $awards = AwardController::getAwards();
        return view('experience', [
            'workExperience'=> $workExperiece,
            'education'=> $education,
            'certifications'=> $certifications,
            'awards'=> $awards
        ]);
    }
}
