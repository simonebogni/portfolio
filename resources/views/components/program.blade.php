<div>
    <h5 class="h5">{{$program->name}}</h5>
    @if ($repeatInstitute && $program->institute_id != null)
    <h6 class="h6">From <span class="program-institute-name">{{$program->institute->name}}</span>
        @if ($program->online_platform_id != null)
            on <span class="program-online-platform-name">{{$program->onlinePlatform->name}}</span>
        @endif
    </h6>
    @else
    @if ($program->online_platform_id != null)
    <h6 class="h6">On <span class="program-online-platform-name">{{$program->onlinePlatform->name}}</span></h6>
    @endif
    @endif
    @if ($program->period != null)
    <p class="program-period">{{$program->period}}</p>
    @else
    @if ($program->start_date != null)
        @if ($program->end_date != null)
        <p class="program-period">{{$program->start_date->format('Y-m-d')}} - {{$program->end_date->format('Y-m-d')}}</p>
        @else
        @if ($program->current != null && $program->current)
        <p class="program-period">{{$program->start_date->format('Y-m-d')}} - currently enrolled</p>
        @endif
        @endif
    @else
        @if ($program->end_date != null)
        <p class="program-period">Completed on {{$program->end_date->format('Y-m-d')}}</p>
        @else
        @if ($program->current != null && $program->current)
        <p class="program-period">Currently enrolled</p>
        @endif
        @endif
    @endif
    @endif
    @if ($program->description != null)
    <p class="program-description">{{$program->description}}</p>
    @endif
</div>