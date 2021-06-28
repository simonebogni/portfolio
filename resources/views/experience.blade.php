@extends('layouts.app')
@section('content')
<div id="experience">
    @if (isset($workExperience))
    <!-- Work Experience -->
    <div class="row mt-4 mb-3 justify-content-center">
        <div class="col-xs-10">
            <h1 class="h1 text-center">Work experience</h1>
        </div>
    </div>
    <div class="row justify-content-center">
    @foreach ($workExperience as $company)
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <x-company :company="$company"></x-company>
        </div>
    @endforeach
    </div>
    @endif
    @if (isset($education))
    <!-- Education -->
    <div class="row mt-3 mb-3 justify-content-center">
        <div class="col-xs-10">
            <h1 class="h1 text-center">Education & Courses</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        @if (isset($education["priorityInstitutes"]))    
        @foreach ($education["priorityInstitutes"] as $institute)
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <x-institute :institute="$institute"></x-institute>
        </div>
        @endforeach
        @endif
        @if (isset($education["programsLowInstitutePriority"]))
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <x-program-aggregation :programs="$education['programsLowInstitutePriority']"></x-program-aggregation>
        </div>
        @endif
    </div>
    @endif
    @if (isset($certifications))
    <!-- Certifications -->
    <div class="row mt-3 mb-3 justify-content-center">
        <div class="col-xs-10">
            <h1 class="h1 text-center">Certifications</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($certifications as $certificate)
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <x-certificate :certificate="$certificate"></x-certificate>
        </div>
        @endforeach
    </div>
    @endif
    @if (isset($awards))
    <!-- Awards -->
    <div class="row mt-3 mb-3 justify-content-center">
        <div class="col-xs-10">
            <h1 class="h1 text-center">Awards</h1>
        </div>
    </div>
    @endif
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/experience.js')}}"></script>
@endsection
