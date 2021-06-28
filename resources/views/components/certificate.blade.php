<div class="card card-certificate mb-3 w-100">
    <div class="card-header card-header-certificate">
        <span class="certificate-title h4">{{$certificate->title}}</span>
    </div>
    <div class="card-body card-body-certificate">
        <div class="row">
            <div class="col">
                <p class="h5">
                    Issued by 
                    <span class="certificate-issuer">{{$certificate->issued_by}}</span> 
                    on 
                    <span class="certificate-date">{{$certificate->issue_date->format('Y-m-d')}}</span>
                </p>
                @if (isset($certificate->url))
                <p><a class="certificate-url" href="{{$certificate->url}}" target="_blank" rel="noopener noreferrer">View the certificate</a></p>
                @endif
            </div>
        </div>
        @if (isset($certificate->tags))
        <div class="row certificate-tags">
            <div class="col">
                @foreach ($certificate->tags->sortBy('category') as $tag)
                    <x-tag :tag="$tag"></x-tag>
                @endforeach
            </div>
        </div>
        @endif
        @if (isset($certificate->description))
        <div class="row">
            <div class="col certificate-description">
                {{$certificate->description}}
            </div>
        </div>
        @endif
    </div>
</div>