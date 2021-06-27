<div>
    <h5 class="h5 position-title">{{$position->title}}</h4>
    <h6 class="h6 position-duration">{{$position->period}}</h6>
    @if (isset($position->tags))
    <p>
        @foreach ($position->tags->sortBy('category') as $tag)
            <x-tag :tag="$tag"></x-tag>
        @endforeach
    </p>
    @endif
    <p class="position-description">{{$position->description}}</p>
</div>