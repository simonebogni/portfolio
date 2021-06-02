@extends('layouts.app')
@section('content')
<div id="about">
    <div class="row mt-5 justify-content-center">
        <div class="col-4 col-md-3 mb-5 mb-md-0 align-self-center">
            <img src="data:image/jpeg;base64,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" alt="Simone Bogni's face" id="profile-pic" class="img-fluid rounded-circle">
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
</div>
<!--
<div dir={dir} className="about">
    
    {/*Programming languages proficiency section*/}
    <Row className="mt-5">
        <Col xs={12} className="text-center">
            <h1 dir={dir}>{this.state.about[languageSelected].titleProgrammingLanguage}</h1>
        </Col>
    </Row>
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
