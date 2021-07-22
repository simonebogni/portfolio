<div>
    <h5 class="h5 position-title">{{$position->title}}</h4>
    <h6 class="h6 position-duration">{{$position->period}}</h6>
    @if (isset($position->tags))
    <div class="row tags-container">
        <div class="col">
            @foreach ($position->tags->sortBy('category') as $tag)
                <x-tag :tag="$tag"></x-tag>
            @endforeach
        </div>
    </div>
    @endif
    <p class="position-description mt-2">{!! $position->description !!}</p>
</div>