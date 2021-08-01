@extends('layouts.app')

@section('content')
<div id="hobbies">
    @if (isset($hobbies))
    <div class="row mt-4 mb-3 justify-content-center">
        <div class="col-xs-10">
            <h1 class="h1 text-center header">My hobbies</h1>
        </div>
    </div>
    <div class="row justify-content-center hobby-row">
    @foreach ($hobbies as $hobby)
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex align-items-stretch align-content-between hobby-col">
            <x-hobby :hobby="$hobby"></x-hobby>
        </div>
    @endforeach
    </div>
    @endif
</div>
@endsection
