<div class="card card-award mb-3 w-100">
    <div class="card-header card-header-award">
        <span class="award-title h4">{{$award->title}}</span>
    </div>
    <div class="card-body card-body-award">
        @if ($award->subtitle != null)
        <div class="row">
            <div class="col">
                <p class="h5 award-subtitle">
                    {{$award->subtitle}}
                </p>
            </div>
        </div>
        @endif
        @if (isset($award->tags))
        <div class="row award-tags">
            <div class="col">
                @foreach ($award->tags->sortBy('category') as $tag)
                    <x-tag :tag="$tag"></x-tag>
                @endforeach
            </div>
        </div>
        @endif
        @if ($award->description != null)
        <div class="row">
            <div class="col award-description">
                {{$award->description}}
            </div>
        </div>
        @endif
    </div>
</div>