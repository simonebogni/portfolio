<nav class="navbar-custom navbar navbar-expand-md navbar-dark bg-dark fixed-top dir-controller container-fluid" dir="ltr">
    <a class="logo navbar-brand" href="/about">
        <img src="{{asset("assets/img/logo.svg")}}" alt="SB.dev logo" height="50"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{url("/about")}}" class="nav-link customNavbarLink 
                @if (\Request::is('about') || \Request::is('/'))  
                active customNavbarActiveLink
                @endif
                ">About me</a></li>
            <li class="nav-item"><a href="{{url("/experience")}}" class="nav-link customNavbarLink 
                @if (\Request::is('experience'))  
                active customNavbarActiveLink
                @endif
                ">Experience</a></li>
            <li class="nav-item"><a href="{{url("/portfolio")}}" class="nav-link customNavbarLink 
                @if (\Request::is('portfolio'))  
                active customNavbarActiveLink
                @endif
                ">Portfolio</a></li>
            <li class="nav-item"><a href="{{url("/softskills")}}" class="nav-link customNavbarLink 
                @if (\Request::is('softskills'))  
                active customNavbarActiveLink
                @endif
                ">Soft skills</a></li>
            <li class="nav-item"><a href="{{url("/hobbies")}}" class="nav-link customNavbarLink 
                @if (\Request::is('hobbies'))  
                active customNavbarActiveLink
                @endif
                ">Hobbies</a></li>
            <li class="nav-item"><button class="btn btn-primary" id="settingsButton" data-toggle="modal" data-target="#settingsModal">Settings</button></li>
        </ul>
    </div>
</nav>
<div id="settingsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="h4 modal-title" id="exampleModalLongTitle">Settings</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-10" aria-hidden="true">
                        <h5 class="h5" id="verbosityLabel">Verbosity</h5>
                    </div>
                    <div class="col-2">
                        <div class="custom-control custom-switch float-right">
                            <input type="checkbox" class="custom-control-input" id="verbosityCheckbox" aria-labelledby="#verbosityLabel">
                            <label class="custom-control-label" for="verbosityCheckbox"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>If this option is activated, the descriptions of various elements in the About section will be shown.</p>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-10" aria-hidden="true">
                        <h5 class="h5" id="showTagsLabel">Show tags</h5>
                    </div>
                    <div class="col-2">
                        <div class="custom-control custom-switch float-right">
                            <input type="checkbox" class="custom-control-input" id="showTagsCheckbox" aria-labelledby="#showTagsLabel">
                            <label class="custom-control-label" for="showTagsCheckbox"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>If this option is activated, several tags will be shown in the Experience and Portfolio sections.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        /*
        * Initialise verbosity variables based on value in localStorage
        * If there is no entry, set it to true
        */
        let localStorageVerbosity = localStorage.getItem("verbosity");
        if(localStorageVerbosity === null){
            $("#app").attr("verbosity", "true");
            $("#verbosityCheckbox").attr("checked", "checked");
        } else {
            $("#app").attr("verbosity", localStorageVerbosity);
            if(localStorageVerbosity === "true"){
                $("#verbosityCheckbox").attr("checked", "checked");
            } else {
                $("#verbosityCheckbox").removeAttr("checked");
            }
        }
        //verbosity checkbox change listener
        $("#verbosityCheckbox").change(function(){
            if(this.checked){
                $("#app").attr("verbosity", "true");
                localStorage.setItem("verbosity", "true");
            } else {
                $("#app").attr("verbosity", "false");
                localStorage.setItem("verbosity", "false");
            }
        });

        /*
        * Initialise showTags variables based on value in localStorage
        * If there is no entry, set it to true
        */
        let localStorageShowTags = localStorage.getItem("showTags");
        if(localStorageShowTags === null){
            $("#app").attr("showTags", "true");
            $("#showTagsCheckbox").attr("checked", "checked");
        } else {
            $("#app").attr("showTags", localStorageShowTags);
            if(localStorageShowTags === "true"){
                $("#showTagsCheckbox").attr("checked", "checked");
            } else {
                $("#showTagsCheckbox").removeAttr("checked");
            }
        }
        //verbosity checkbox change listener
        $("#showTagsCheckbox").change(function(){
            if(this.checked){
                $("#app").attr("showTags", "true");
                localStorage.setItem("showTags", "true");
            } else {
                $("#app").attr("showTags", "false");
                localStorage.setItem("showTags", "false");
            }
        });
    });
</script>