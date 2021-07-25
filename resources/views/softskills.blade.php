@extends('layouts.app')

@section('content')
<div id="softskills">
    @if (isset($softskills))
    <!-- Work Experience -->
    <div class="row mt-4 mb-3 justify-content-center">
        <div class="col-xs-10">
            <h1 class="h1 text-center header">My soft skills</h1>
        </div>
    </div>
    <div class="row justify-content-center softskill-row">
    @foreach ($softskills as $softskill)
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex align-items-stretch align-content-between softskill-col">
            <x-soft-skill :softskill="$softskill"></x-soft-skill>
        </div>
    @endforeach
    </div>
    @endif
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/softskills.js')}}"></script>
@endsection
