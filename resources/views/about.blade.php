@extends('layouts.app')
@section('content')
<div id="about">
    <div class="row mt-5 justify-content-center">
        <div class="col-4 col-md-4 mb-5 mb-md-0 align-self-center">
            <img src="{{asset('assets/img/profile.jpg')}}" alt="Simone Bogni's face" id="profile-pic" class="img-fluid rounded-circle ml-auto mr-auto">
        </div>
        <div class="col-xs-12 col-md-8 align-self-center">
            <div id="description">
                <p><span role="img" aria-label="Waving hand">👋🏼</span> Hello, my name is Simone, a <strong>full stack webdeveloper</strong>.</p>
                <p><span role="img" aria-label="Strong">💪🏼</span> Proficiency in both <strong>back-end</strong> and <strong>front-end development</strong>, including with <strong>REST</strong> and <strong>MVC-based frameworks</strong>.</p>
                <p><strong>Responsible</strong> and <strong>independent</strong> and can effectively self-manage during projects, as well as collaborate in a team environment.</p>
                <p><span role="img" aria-label="Books">📚</span> <strong>Open-minded</strong> and <strong>flexible</strong>, committed to the process of life-long learning, with an autodidact approach. Always happy for <strong>more opportunities to learn</strong>.<br/>Completed several courses on platforms such as EdX, Coursera, Udacity, Udemy and FreeCodeCamp. Check the <strong><a href="{{url('/experience#education')}}">Experience</a></strong> section!</p>
                <p><span role="img" aria-label="University hat">🎓</span> <strong>Bachelor degree in Computer Science</strong> with a score of 95%.</p>
                <p><span role="img" aria-label="Developer">👨🏻‍💻</span> You can see my projects like <strong><a href="{{url('/portfolio#webapps')}}">fully responsive Progressive Web Applications <i class="fas fa-external-link-alt certificate-link-icon"></i></a></strong> and <strong><a href="{{url('/portfolio#java')}}">Java desktop apps <i class="fas fa-external-link-alt certificate-link-icon"></i></a></strong> in the <strong><a href="{{url("/portfolio/")}}">Portfolio <i class="fas fa-external-link-alt certificate-link-icon"></i></a></strong> section.<br/>
                I really love the <strong>feeling of accomplishment</strong> that comes from bringing a product from an idea to reality.</p>
                <p><span role="img" aria-label="Office building">🏢</span> I'm looking forward to work with you to help your company grow as best as I can.</p>
            </div>
        </div>
    </div>
    @if (isset($languages))
    <div class="row">
        <div class="col-12 mt-5 text-center">
            <h1 class="h1 header">Spoken languages</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($languages as $language)
        <x-language :language="$language"></x-language>
        @endforeach
    </div>
    @endif
    @if (isset($skillCategories))
        <div class="row">
            <div class="col-12 mt-5 text-center">
                <h1 class="h1 header">Programming knowledge</h1>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            @foreach ($skillCategories as $skillCategory)
            <x-skill-category :skillCategory="$skillCategory"></x-skill-category>
            @endforeach
        </div>
    @endif
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/about.js')}}"></script>
@endsection
