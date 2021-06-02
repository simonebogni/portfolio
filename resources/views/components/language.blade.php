<div class="col-12 col-md-6 col-lg-4 mt-4">
    <h2 class="h2 text-center">{{$name}}</h2>
    <div class="row">
        <div class="col-12"><x-ranker current-value="{{$rating}}" max-value="5.0"></x-ranker></div>
        <div class="col-12 text-center">
            <span class="languageRatingMeaning">
                {{$isNative ? "Native" : $ratingMeaning}}
            </span>
        </div>
    </div>
    @if (isset($certificate_level))
        <p><a href="{{$certificate_img_path}}" target="_blank">{{$certificate_level}}</a></p>
    @endif
</div>