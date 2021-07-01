<div class="card card-portfolio-item mb-3 w-100">
    <div class="card-header card-header-portfolio-item">
        <span class="portofolio-item-title h4">{{$item->title}}</span>
    </div>
    @if (isset($item->cover_img_url))
    <img class="card-img-top" src="{{$item->cover_img_url}}" alt="Cover image for {{$item->title}}" aria-hidden="true">
    @endif
    <div class="card-body card-body-portfolio-item pt-0">
        @if (isset($item->subtitle))
        <div class="row portofolio-item-subtitle-container pt-3">
            <div class="col">
                <p class="h5 text-center portofolio-item-subtitle">
                    {{$item->subtitle}}
                </p>
            </div>
        </div>
        @endif
        @if (isset($item->tags))
        <div class="row portfolio-item-tags tags-container pt-3">
            <div class="col">
                @foreach ($item->tags->sortBy('category') as $tag)
                    <x-tag :tag="$tag"></x-tag>
                @endforeach
            </div>
        </div>
        @endif
        @if (isset($item->description))
        <div class="row pt-3">
            <div class="col portfolio-item-description">
                {!! nl2br(e($item->description)) !!}
            </div>
        </div>
        @endif
        @if (isset($item->live_url) || isset($item->git_repo_url))
        <div class="row pt-3">
            @if (isset($item->live_url))
            <div class="col-12 col-sm-6 col-md-4">
                <a type="button" class="btn btn-block purpleButtonOutline portfolio-item-live-url" href="{{$item->live_url}}" target="_blank" rel="noopener noreferrer">
                    Watch it live!
                </a>
            </div>
            @endif
            @if (isset($item->git_repo_url))
            <div class="col-12 col-sm-6 col-md-4">
                <a type="button" class="btn btn-block purpleButtonOutline portfolio-item-gir_repo-url" href="{{$item->git_repo_url}}" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-git-square" aria-hidden="true"></i> Go to the git repo
                </a>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>