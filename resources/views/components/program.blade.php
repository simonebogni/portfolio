<div>
    <h5 class="h5">{{$program->name}}</h5>
    @if ($repeatInstitute && $program->institute_id != null)
    <h6 class="h6">From <span class="program-institute-name">{{$program->institute->name}}</span>
        @if ($program->online_platform_id != null)
            on <span class="program-online-platform-name">{{$program->onlinePlatform->name}}</span>
        @endif
    </h6>
    @else
    @if ($program->online_platform_id != null)
    <h6 class="h6">On <span class="program-online-platform-name">{{$program->onlinePlatform->name}}</span></h6>
    @endif
    @endif
    @if ($program->period != null)
    <p class="program-period">{{$program->period}}</p>
    @else
    @if ($program->start_date != null)
        @if ($program->end_date != null)
        <p class="program-period">{{$program->start_date->format('Y-m-d')}} - {{$program->end_date->format('Y-m-d')}}</p>
        @else
        @if ($program->current != null && $program->current)
        <p class="program-period">{{$program->start_date->format('Y-m-d')}} - currently enrolled</p>
        @endif
        @endif
    @else
        @if ($program->end_date != null)
        <p class="program-period">Completed on {{$program->end_date->format('Y-m-d')}}</p>
        @else
        @if ($program->current != null && $program->current)
        <p class="program-period">Currently enrolled</p>
        @endif
        @endif
    @endif
    @endif
    @if ($program->tags != null)
    <div class="row program-tags tags-container">
        <div class="col">
            @foreach ($program->tags->sortBy('category') as $tag)
                <x-tag :tag="$tag"></x-tag>
            @endforeach
        </div>
    </div>
    @endif
    @if ($program->description != null)
    <div class="row program-description">
        <div class="col">
            <p>{{$program->description}}</p>
        </div>
    </div>
    @endif
    @if ($showCourses && $program->courses != null)
    <div class="row program-courses-wrapper">
        <div class="col-12 col-sm-6 col-md-4">
            <button type="button" class="btn btn-block purpleButtonOutline" data-toggle="modal" data-target="#modal-courses-{{$program->id}}">
                Show courses
            </button>
            <div class="modal fade" id="modal-courses-{{$program->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content modal-courses-content">
                        <div class="modal-header modal-courses-header">
                            <h5 class="modal-title h5" id="modal-courses-{{$program->id}}-label">Courses of {{$program->name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body modal-courses-body">
                            <table class="table" id="table-courses-{{$program->id}}">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Score (%)</th>
                                        <th scope="col">Cum Laude</th>
                                        <th scope="col">Exam date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($program->courses as $course)
                                    <tr>
                                        <td scope="row">
                                            <p class="course-name">
                                                {{$course->name}}
                                            </p>
                                            @if ($course->description != null)
                                            <p class="course-description">{{$course->description}}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($course->score_max != null && $course->score != null)
                                                {{number_format($course->score/$course->score_max*100, 2)}}
                                            @else
                                                No score
                                            @endif
                                        </td>
                                        <td>
                                            @if ($course->cum_laude != null && $course->cum_laude)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>
                                            @if ($course->exam_date != null)
                                                {{$course->exam_date->format('Y-m-d')}}
                                            @else
                                                No date
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer modal-courses-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready( function () {
            $("#table-courses-{{$program->id}}").DataTable();
        } );
    </script>
    @endif
</div>