@extends('layouts.app')
@section('content')
<div id="about">
    <div class="row mt-5 justify-content-center">
        <div class="col-4 col-md-3 mb-5 mb-md-0 align-self-center">
            <img src="{{asset('assets/img/profile.jpg')}}" alt="Simone Bogni's face" id="profile-pic" class="img-fluid rounded-circle">
        </div>
        <div class="col-xs-12 col-md-8 offset-md-1 align-self-center">
            <div id="description">
                <p><span role="img" aria-label="Waving hand">👋🏼</span> Hello, my name is Simone Bogni, I am a <strong>full stack webdeveloper</strong> with a good competence in various stages of development, including the design of the system and database.</p>
                <p><span role="img" aria-label="Strong">💪🏼</span> I'm proficient in various programming languages and products and I have good <strong>problem solving skills</strong>.<br>
                I have a good proficiency in both <strong>back-end and front-end development</strong>, including with MVC-based frameworks.</p>
                <p>I am <strong>responsible</strong> and <strong>independent</strong> and I can  effectively self-manage during projects, as well as collaborate in a team environment.</p>
                <p><span role="img" aria-label="Books">📚</span> I'm <strong>open-minded</strong> and <strong>flexible</strong>, committed to the process of life-long learning, with an autodidact approach. I'm <strong>looking forward for more opportunities to learn</strong> and I have completed several courses on platforms such as EdX, Coursera, Udacity, Udemy and FreeCodeCamp.</p>
                <p><span role="img" aria-label="University hat">🎓</span> I have attained the <strong>Bachelor diploma in Computer Science</strong> with a score of 95% and I have a business and economics background too.</p>
                <p><span role="img" aria-label="Developer">👨🏻‍💻</span> So far I have built various projects including <strong>fully responsive websites</strong>, <strong>Progressive Web Applications</strong> and <strong>Java desktop apps</strong>.<br/>
                I really love the <strong>feeling of accomplishment</strong> that I get when I bring a product from an idea to reality.</p>
            </div>
        </div>
    </div>
    @if (isset($languages))
    <div class="row">
        <div class="col-12 mt-5 text-center">
            <h1 class="h1">Spoken languages</h1>
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
                <h1 class="h1">Programming knowledge</h1>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">

        </div>
    @endif
</div>
<!--
<div dir={dir} className="about">
    <Row className="mt-5 justify-content-center">
        {/* Java */}
        <Col xs={12} md style={minWidth: "33%"}>
            <Button block onClick={this.toggleJava} className={"purpleButtonOutline"+(this.state.javaOpen ? " open":"")}>
                <h2 className="text-center" dir={dir}><FontAwesomeIcon icon={["fab", "java"]} onClick={this.toggleJava}/> Java</h2>
            </Button>
        </Col>
        <Col className="text-center" xs={12} style={display: this.state.javaOpen ? "block" : "none"}>
            {javaExpandedSection}
        </Col>

        {/* PHP */}
        <Col xs={12} style={display: this.state.phpOpen ? "block" : "none"}>
        </Col>
        <Col xs={12}  md style={minWidth: "33%"}>
            <Button block onClick={this.togglePhp} className={"purpleButtonOutline"+(this.state.phpOpen ? " open":"")}>
                <h2 className="text-center" dir={dir}><FontAwesomeIcon icon={["fab", "php"]}/> PHP</h2>
            </Button>
        </Col>
        <Col className="text-center" xs={12} style={display: this.state.phpOpen ? "block" : "none", marginBottom: "15px"}>
            {phpExpandedSection}
        </Col>
        {/* JavaScript*/}
        <Col xs={12} style={display: this.state.javaScriptOpen ? "block" : "none"}>
        </Col>
        <Col xs={12} md style={minWidth: "33%"}>
            <Button block onClick={this.toggleJavaScript} className={"purpleButtonOutline"+(this.state.javaScriptOpen ? " open":"")}>
                <h2 className="text-center" dir={dir}><FontAwesomeIcon icon={["fab", "js-square"]}/> Javascript</h2>
            </Button>
        </Col>
        <Col className="text-center" xs={12} style={display: this.state.javaScriptOpen ? "block" : "none",  marginBottom: "15px"}>
            {javascriptExpandedSection}
        </Col>

        {/* HTML & CSS*/}
        <Col xs={12} style={display: this.state.htmlCssOpen ? "block" : "none"}>
        </Col>
        <Col xs={12} md style={minWidth: "33%"}>
            <Button block onClick={this.toggleHtmlCss} className={"purpleButtonOutline"+(this.state.htmlCssOpen ? " open":"")}>
                <h2 className="text-center" dir={dir}><FontAwesomeIcon icon="file-code"/> HTML+CSS</h2>
            </Button>
        </Col>
        <Col className="text-center" xs={12} style={display: this.state.htmlCssOpen ? "block" : "none",  marginBottom: "15px"}>
            {htmlCssExpandedSection}
        </Col>

        {/* Databases*/}
        <Col xs={12} style={display: this.state.databaseOpen ? "block" : "none"}>
        </Col>
        <Col xs={12} md style={minWidth: "33%"}>
            <Button block onClick={this.toggleDatabase} className={"purpleButtonOutline"+(this.state.databaseOpen ? " open":"")}>
                <h2 className="text-center" dir={dir}><FontAwesomeIcon icon="database"/> Databases</h2>
            </Button>
        </Col>
        <Col className="text-center" xs={12} style={display: this.state.databaseOpen ? "block" : "none",  marginBottom: "15px"}>
            {databaseExpandedSection}
        </Col>

        {/* Tools*/}
        <Col xs={12} style={display: this.state.toolsOpen ? "block" : "none"}>
        </Col>
        <Col xs={12} md style={minWidth: "33%"}>
            <Button block onClick={this.toggleTools} className={"purpleButtonOutline"+(this.state.toolsOpen ? " open":"")}>
                <h2 className="text-center" dir={dir}><FontAwesomeIcon icon="tools"/> Tools</h2>
            </Button>
        </Col>
        <Col className="text-center" xs={12} style={display: this.state.toolsOpen ? "block" : "none",  marginBottom: "15px"}>
            {toolsExpandedSection}
        </Col>
    </Row>
</div>
-->
@endsection
