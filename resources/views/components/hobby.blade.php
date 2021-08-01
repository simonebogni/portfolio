<div class="card card-hobby mb-3 w-100 h-100">
    <div class="card-header card-header-hobby">
        <span class="hobby-title h4">{{$hobby->title}}</span>
    </div>
    <div class="card-body card-body-hobby" 
    @if (isset($hobby->cover_img_url))
    style="background-image: url({{$hobby->cover_img_url}})"
    @endif
    >
        @if ($hobby->description != null)
        <div class="hobby-description-container d-flex">
            <div class="row d-flex">
                <div class="col hobby-description justify-content-center">
                    {{$hobby->description}}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>