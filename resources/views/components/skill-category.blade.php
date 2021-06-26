<div class="col-12 col-sm skill-category-button-container" id="skill-category-button-container-{{$skillCategory->id}}">
    <button class="btn btn-block purpleButtonOutline skill-category-button" id="skill-category-button-{{$skillCategory->id}}" categoryId="{{$skillCategory->id}}">
        <h2 class="h2 text-center skill-category-button-text">
            @if (isset($skillCategory->icon_class))
                <i class="{{$skillCategory->icon_class}}"></i>&nbsp;
            @endif
            {{$skillCategory->name}}
        </h2>
    </button>
</div>
<div class="col-12 skill-category-content" visibility="false" id="skill-category-content-{{$skillCategory->id}}">
    <div class="expanded-section">
        @foreach ( $skillCategory->subcategories as $subcategory )
        <h3 class="h3 AboutTitle text-center">{{$subcategory->name}}</h3>
        @foreach ( $subcategory->skills as $index => $skill)  
        <div class="row AboutDetailsRow verbosity-on">
            <div class="col col-md-4 align-items-center justify-content-center d-inline-flex ">
                <img src="{{$skill->picture_source}}" class="svgLogo" alt="{{$skill->name}} logo"/>
            </div>
            <div class="col col-md-8 d-inline-flex align-items-center">
                <div>
                    @if($skill->familiarity)
                    <div>
                        <h4 class="h4 text-center text-md-left d-inline">{{$skill->name}}</h4>
                        <h5 class="h6 AboutBreifExperience d-inline"> (Brief experience)</h5>
                    </div>
                    @else
                        <h4 class="h4 text-center text-md-left">{{$skill->name}}</h4>
                    @endif
                    <p class="AboutDetailsParagraph">{{$skill->description}}</p>
                </div>
            </div>
        </div>
        <div class="row AboutDetailsRow verbosity-off" aria-hidden="true">
            <div class="col col-md-6 align-items-center justify-content-center d-inline-flex ">
                <img src="{{$skill->picture_source}}" class="svgLogo" alt="{{$skill->name}} logo"/>
            </div>
            <div class="col col-md-6 d-inline-flex align-items-center">
                <div>
                    <h4 class="h4 text-center text-md-left">{{$skill->name}}</h4>
                </div>
            </div>
        </div>
        @endforeach
        @endforeach
    </div>
</div>