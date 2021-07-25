@php
    $carouselimageclasses = "d-block w-100";
@endphp
<div class="anchor w-100 mb-3" id="{{$item->slug}}">
    <div class="card card-portfolio-item mb-1 w-100 h-100">
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
                    <a type="button" class="btn btn-block purpleButtonOutline portfolio-item-button portfolio-item-live-url" href="{{$item->live_url}}" target="_blank" rel="noopener noreferrer">
                        View it live!
                    </a>
                </div>
                @endif
                @if (isset($item->git_repo_url))
                <div class="col-12 col-sm-6 col-md-4">
                    <a type="button" class="btn btn-block purpleButtonOutline portfolio-item-button portfolio-item-git_repo-url" href="{{$item->git_repo_url}}" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-git-square" aria-hidden="true"></i> Go to the git repo
                    </a>
                </div>
                @endif
                @if (sizeOf($item->images) > 0)
                <div class="col-12 col-sm-6 col-md-4">
                    <button class="btn btn-block purpleButtonOutline portfolio-item-button portfolio-item-gallery-button" id="gallery-button-{{$item->id}}" data-toggle="modal" data-target="#modal-gallery-{{$item->id}}">
                        <i class="fas fa-images" aria-hidden="true"></i> View the gallery
                    </button>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="modal-gallery-{{$item->id}}" tabindex="-1" aria-labelledby="gallery-button-{{$item->id}}" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modal-gallery-content">
                <div class="modal-header modal-gallery-header">
                    <h5 class="modal-title h5" id="modal-gallery-{{$item->id}}-label">Gallery of {{$item->title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-gallery-body">
                    <div id="modal-gallery-{{$item->id}}-carousel" class="carousel slide">
                        <ol class="carousel-indicators">
                            @foreach ($item->images as $image)
                            @if ($loop->index == 0)
                            <li data-target="#modal-gallery-{{$item->id}}-carousel" data-slide-to="{{$loop->index}}" class="active"></li>
                            @else
                            <li data-target="#modal-gallery-{{$item->id}}-carousel" data-slide-to="{{$loop->index}}"></li>
                            @endif
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($item->images as $image)
                            @if ($loop->index == 0)
                            <div class="carousel-item active">
                                <h6 class="h6 text-center gallery-image-name">{{$image->name}}</h5>
                                <x-image :image="$image" :classes="$carouselimageclasses"></x-image>
                            </div>
                            @else
                            <div class="carousel-item">
                                <h6 class="h6 text-center gallery-image-name">{{$image->name}}</h5>
                                <x-image :image="$image" :classes="$carouselimageclasses"></x-image>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#modal-gallery-{{$item->id}}-carousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#modal-gallery-{{$item->id}}-carousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>
                </div>
                <div class="modal-footer modal-gallery-footer d-block">
                    <div class="row">
                        <div class="col-6 offset-6 col-md-5 offset-md-7 col-lg-3 offset-lg-9">
                            <button type="button" class="btn btn-block purpleButtonOutline mb-0" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>