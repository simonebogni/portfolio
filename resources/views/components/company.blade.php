<div class="card card-company mb-3">
    <div class="card-header card-header-company">
        <span class="company-name h4">{{$company->name}}</span><span class="company-location h5">, {{$company->city}} ({{$company->country}})</span>
    </div>
    <div class="card-body card-body-company @if (isset($company->website)) pt-0 @endif">
        @if (isset($company->website))
        <div class="row">
            <div class="col company-website"><span class="workPlaceLink">{{$company->website}}</span></div>
        </div>
        @endif
        @if (isset($company->description))
        <div class="row">
            <div class="col company-description">
                {{$company->description}}
            </div>
        </div>
        @endif
        @if (isset($company->workPositions))
        <div class="row">
            @foreach ($company->workPositions as $position)
            <div class="col-12">
                <x-work-position :position="$position"></x-work-position>
            </div>
            @endforeach 
        </div>
        @endif
    </div>
</div>