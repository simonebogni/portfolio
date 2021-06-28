<div class="card card-institute mb-3 w-100">
    <div class="card-header card-header-institute">
        <span class="institute-name h4">Other courses</span>
    </div>
    <div class="card-body card-body-institute pt-0">
        @if (isset($programs))
            @foreach ($programs as $program)
                <x-program :program="$program" :repeat-institute="true"></x-program>
            @endforeach
        @endif
    </div>
</div>