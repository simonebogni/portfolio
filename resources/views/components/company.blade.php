<div class="card">
    <div class="card-header">
        <span class="company-name">{{$company->name}}</span><span class="company-location">, {{$company->city}} ({{$company->country}})</span>
    </div>
    <div class="card-body">
        @if (isset($company->website))
        <div class="row">
            <div class="col company-website">{{$company->website}}</div>
        </div>
        @endif
        @if (isset($company->description))
        <div class="row">
            <div class="col company-description">
                {{$company->description}}
            </div>
        </div>
        @endif
    </div>
</div>