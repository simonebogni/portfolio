<div class="card card-program-aggregation mb-3 w-100">
    <div class="card-header card-header-program-aggregation">
        <span class="program-aggregation-name h4">Other courses</span>
    </div>
    <div class="card-body card-body-program-aggregation pt-0">
        @if (isset($programs))
            @foreach ($programs->sortByDesc(function($p){
                return (($p->current != null && $p->current) ? "1-" : "0-").($p->end_date != null ? $p->end_date->format('Y-m-d') : "0");
            }) as $program)
                <x-program :program="$program" :repeat-institute="true" :show-courses="false"></x-program>
            @endforeach
        @endif
    </div>
</div>