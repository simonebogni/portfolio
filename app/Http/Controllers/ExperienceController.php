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
        $certifications = CertificateController::getCertificates();
        return view('experience', [
            'workExperience'=> $workExperiece,
            'education'=> [],
            'certifications'=> $certifications,
            'awards'=> []
        ]);
    }
}
