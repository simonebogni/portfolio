<div class="card card-softskill mb-3 w-100 h-100">
    <div class="card-header card-header-softskill">
        <span class="softskill-title h4">{{$softskill->name}}</span>
    </div>
    <div class="card-body card-body-softskill">
        @if ($softskill->description != null)
        <div class="row">
            <div class="col softskill-description">
                {{$softskill->description}}
            </div>
        </div>
        @endif
    </div>
</div>