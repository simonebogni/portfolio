<div class="card card-institute mb-3 w-100">
    <div class="card-header card-header-institute">
        <span class="institute-name h4">{{$institute->name}}</span>
    </div>
    <div class="card-body card-body-institute @if (isset($institute->website)) pt-0 @endif">
        @if (isset($institute->website))
        <div class="row">
            <div class="col institute-website-div"><a class="institute-website" href="{{$institute->website}}" target="_blank" rel="noopener noreferrer">{{$institute->website}}</a></div>
        </div>
        @endif
        @if (isset($institute->programs))
            @foreach ($institute->programs as $program)
                <x-program :program="$program" :repeat-institute="false" :show-courses="true"></x-program>
            @endforeach
        @endif
    </div>
</div>