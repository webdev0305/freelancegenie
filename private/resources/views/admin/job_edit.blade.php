@extends('layouts.admin.dashboard')
@section('page_heading','Edit Job')
@section('section')
    <style>
        .form-group.mltislct .btn-group {
            width: 100% !important;
        }

        .form-group.mltislct .btn-group .multiselect {
            width: 100% !important;
            background: transparent;
            border-color: #dedede;
            border: 1px solid #ccc;
            box-shadow: none;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            text-align: left;
        }
    </style>
    <div class="row">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h1>Socio Professionista</h1>
                    <div id='progress'>
                        <div id='progress-complete'></div>
                    </div>

                    {{ Form::model($jobs, array('route' => array('job.update', \encrypt($jobs->id)),'id' => 'jobForm' ,'method' => 'PUT','enctype'=>'multipart/form-data') ) }}

                    @include('message.message')
                    <fieldset>
                        <legend>Informazioni Generali</legend>
                        <div class="row">

                            <input class="form-control" id="tutor_id" name="tutor_id"
                                   value="{{ isset($jobs->tutor->id) ? encrypt($jobs->tutor->id) :'' }}"
                                   type="hidden"/>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group ">
                                    <label class="control-label" for="title">
                                        Tutor Name
                                    </label>
                                    {{--{{$jobs->tutor->first_name}} {{$jobs->tutor->last_name}}--}}
                                    <input class="form-control" disabled
                                           value="{{ isset($jobs->tutor->first_name) ? $jobs->tutor->first_name .''.$jobs->tutor->last_name :'' }}"
                                           type="text"/>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group ">
                                    <label class="control-label" for="title">
                                        Employer Name
                                    </label>
                                    <input class="form-control" disabled
                                           value="{{$jobs->employer->first_name}} {{$jobs->employer->last_name}}"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group ">
                                    <label class="control-label" for="title">
                                        Title
                                    </label>
                                    <input class="form-control" id="title" value="{{$jobs->title}}" name="title"
                                           type="text"/>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
							
								@if($jobs->type)
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group ">
                                    <label class="control-label" for="type">
                                        Types
                                    </label>
                                    @if(isset($jobs->tutor_id))
                                        <select class="form-control" id="type_levels"
                                                onchange="fetch_select(this.value);" name="type_levels">
                                            <option value="">Type</option>
                                            @foreach($disciplines as  $discipline)
                                                <option value="{{$discipline->disciplines->id}}" {{$discipline->disciplines->id == $jobs['disciplines']->id ? ' selected="selected" ' : ''}}>{{$discipline->disciplines->name}}</option>

                                            @endforeach
                                        </select>
                                    @else

                                        <select class="form-control" name="type_levels">
                                            <option value="">Type</option>
                                            @foreach($disciplines as  $discipline)
                                                @if(isset($discipline->childrenDisciplines['0']))
                                                    <optgroup label="{{$discipline->name}}"
                                                              data-max-options="1">
                                                        @foreach($discipline->childrenDisciplines as  $disciplineChild)
                                                            <option value="{{$disciplineChild->id}} " {{$disciplineChild->id == $jobs->sub_disciplines_id ? ' selected="selected" ' : ''}} >{{$disciplineChild->name}}</option>                                                                            @endforeach
                                                @endif
                                            @endforeach
                                        </select>

                                    @endif
                                    @if ($errors->has('qualified_levels'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('qualified_levels') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
							
								@endif
                        </div>
						
							@if($jobs->type)
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group ">
                                    <label class="control-label" for="title">
                                        Specialist
                                    </label>
                                    @if(isset($jobs->tutor_id))
                                        <select class="form-control"  onchange="fetch_select_cat(this.value);" id="specialist"
                                                 name="specialist">
                                            <option value="">Specialist</option>
                                            {{--<option value="{{$discipline->disciplines->id}}">{{$discipline->disciplines->name}}</option>--}}
                                        </select>

                                        @else

                                        <select class="form-control" id="specialist"
                                                name="specialist">
                                        @foreach($categories as  $categorie)
                                            @if(isset($categorie->children['0']))
                                                <optgroup label="{{$categorie->name}}"
                                                          data-max-options="1">
                                                    @foreach($categorie->children as  $categorieChild)
                                                        <option value="{{$categorieChild->id}} " {{$categorieChild->id == $jobs['categories']->id ? ' selected="selected" ' : ''}}>{{$categorieChild->name}}</option>                                                                 @endforeach
                                                    @endif
                                                    @endforeach
                                        </select>
                                    @endif
                                    @if ($errors->has('specialist'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('specialist') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group ">
                                    <label class="control-label" for="rate">
                                        Qualified Levels
                                    </label>
                                    @if(isset($jobs->tutor_id))
                                        <select class="form-control" id="qualified_levels"
                                        onchange="fetch_select(this.value);" name="qualified_levels">
                                        <option value="">Level</option>
                                        </select>
                                        @else
                                        <select class="form-control" id="qualified_levels"
                                                name="qualified_levels">
                                            @foreach($levels as  $level)
                                                @if(isset($level->childrenLevels['0']))
                                                    <optgroup label="{{$level->level}}"
                                                              data-max-options="1">
                                                        @foreach($level->childrenLevels as  $levelChild)
                                                            <option value="{{$levelChild->id}} " {{$levelChild->id == $jobs['qualifiedlevels']->id ? ' selected="selected" ' : ''}}>{{$levelChild->level}}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>

                                    @endif
                                    @if ($errors->has('qualified_levels'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('qualified_levels') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
						@endif

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group ">
                                    <label class="control-label" for="title">
                                        Type
                                    </label>
                                    <select class="form-control" name="type">
                                        <option value="0" {{ '0' == $jobs->type ? 'selected="selected"' : '' }}>Daily
                                        </option>
                                        <option value="1" {{ '1' == $jobs->type ? 'selected="selected"' : '' }}>Hourly
                                        </option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">

                                <div class="form-group ">
                                    <label class="control-label" for="date">
                                        Date
                                    </label>
                                    <input class="form-control" name="date" readonly="" type="text" id="date">
                                    @if ($errors->has('date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group ">
                                    <label class="control-label" for="description">
                                        Description
                                    </label>
                                    <textarea class="form-control" name="description"> {{$jobs->description}}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(!isset($jobs->tutor_id))
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group ">
                                    <label class="control-label" for="description">
                                        File
                                    </label>
                                    <input type="file" class="form-control" id="file" name="file">
                                    @if($jobs->file)
                                    <a href="{{asset('/images/job_files/').'/'.$jobs->file}}" download>Download</a>
                                    @endif
                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>

                                    @endif
                                </div>
                            </div>

                                @else
                                    <div class="col-md-6 col-sm-6">

                                        <div class="form-group ">
                                            <label class="control-label" for="Rate">
                                                Rate
                                            </label>
                                            <input class="form-control"  readonly="" type="text" id="rate">

                                        </div>
                                    </div>
                            @endif
                        </div>


                        <div class="text-right">
                            <input class="btn btn-primary next" type="submit" value="Update">
                        </div>


                    </fieldset>
                    {{ Form::close() }}
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <form action="{{url('admin/assign_job')}}" method="post">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input name="job_id" required value="{{$jobs->id}}" type="hidden"/>
                        <fieldset>
                            <legend>Informazioni Generali</legend>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group ">
                                        <label class="control-label" for="title">
                                            Employer Name
                                        </label>
                                        <input class="form-control" disabled
                                               value="{{$jobs->employer->first_name}} {{$jobs->employer->last_name}}"
                                               type="text"/>
                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group  mltislct">
                                        <label>
                                            Select Tutor
                                        </label>
                                        <select class="form-control" name="tutor_assign[]" id="tutor_assign"
                                                multiple="">
                                            @if(isset($jobs->tutor->first_name))
                                                <option value="{{$jobs->tutor->id}}"
                                                        selected>{{$jobs->tutor->first_name}}
                                                    (Primary)
                                                </option>

                                                @foreach($usersMeta as  $usersTutor)
                                                    @if($usersTutor['user']->id != $jobs->tutor->id)

                                                        <option value="{{$usersTutor['user']->id}}">{{$usersTutor['user']->first_name}}</option>

                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach($usersMeta as  $usersTutor)
                                                    <option value="{{$usersTutor['user']->id}}">{{$usersTutor['user']->first_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('tutor_assign'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('tutor_assign') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="text-right">
                                <input class="btn btn-primary next" type="submit" value="Assign">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <form action="{{url('admin/assign_job')}}" method="post">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input name="job_id" required value="{{$jobs->id}}" type="hidden"/>
                        <fieldset>
                            <legend>Informazioni Generali</legend>

                            <div class="row">

                                <table>
                                    <tr>
                                        <th>Tutor</th>
                                        <th>Status</th>

                                    </tr>
                                    @foreach($jobs['userJobs'] as $userJobs)
                                        <tr>
                                            <th>{{$userJobs->first_name}}</th>
                                            @if($userJobs->pivot->status == '0')
                                                <th>{{ 'Open'}}</th>
                                            @elseif ($userJobs->pivot->status == '1')
                                                <th>{{ 'Accept'}}</th>
                                            @else
                                                <th>{{'Reject'}}</th>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <style>
                                table {
                                    font-family: arial, sans-serif;
                                    border-collapse: collapse;
                                    width: 100%;
                                }

                                td, th {
                                    border: 1px solid #dddddd;
                                    text-align: left;
                                    padding: 8px;
                                }

                                tr:nth-child(even) {
                                    background-color: #dddddd;
                                }
                            </style>
                            @push('scripts')

                                <script>

                                    $(document).ready(function()
                                    {
                                    detData($("#type_levels").val());
                                    });

                                    function fetch_select(val) {
                                        detData(val)
                                    }


                                    function detData(val){
                                        $.ajax({
                                            type: 'POST',
                                            url: "{{url('/tutors/get_option')}}",
                                            data: {
                                                get_option: val,
                                                tutor_id:  $('#tutor_id').val(),
                                                "_token": "{{ csrf_token() }}"
                                            },
                                            success: function (response) {
                                                if (response.status == '0') {
                                                    document.getElementById("specialist").innerHTML = '<option value="">Specialist</option>';
                                                    document.getElementById("qualified_levels").innerHTML = '<option value="">Level</option>';
                                                } else {
                                                    document.getElementById("specialist").innerHTML = response.categories;
                                                    getLevels($('#specialist').val());
                                                    //    document.getElementById("qualified_levels").innerHTML = response.qualifiedlevel;
                                                }
                                            }

                                        });
                                    }
                                    function fetch_select_cat(val) {

                                        getLevels(val);
                                    }

                                    function getLevels(val){

                                        $.ajax({
                                            type: 'POST',
                                            url: "{{url('/tutors/get_level_by_cat')}}",
                                            data: {
                                                get_option: val,
                                                tutor_id:  $('#tutor_id').val(),
                                                "_token": "{{ csrf_token() }}"
                                            },
                                            success: function (response) {
                                                if (response.status == '0') {
                                                    //    document.getElementById("specialist").innerHTML = '<option value="">Specialist</option>';
                                                    document.getElementById("qualified_levels").innerHTML = '<option value="">Level</option>';
                                                    $('#rate').val('');
                                                } else {
                                                    //   document.getElementById("specialist").innerHTML = response.categories;
                                                    document.getElementById("qualified_levels").innerHTML = response.qualifiedlevel;
                                                    $('#rate').val(response.rate);

                                                }
                                            }

                                        });
                                    }

                                </script>


                                <script type="text/javascript"
                                        src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                                <script type="text/javascript"
                                        src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                                <link rel="stylesheet" type="text/css"
                                      href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>


                                <script>


                                    var disabledArr = ["09/20/2018", "11/28/2016", "12/02/2016", "12/23/2016"];


                                    $("#date").daterangepicker({
                                        minDate: new Date(),
                                        timePicker: true,
                                        locale: {
                                            format: 'M/DD/Y hh:mm A'
                                        },
                                        isInvalidDate: function (arg) {


                                            // Prepare the date comparision
                                            var thisMonth = arg._d.getMonth() + 1;   // Months are 0 based
                                            if (thisMonth < 10) {
                                                thisMonth = "0" + thisMonth; // Leading 0
                                            }
                                            var thisDate = arg._d.getDate();
                                            if (thisDate < 10) {
                                                thisDate = "0" + thisDate; // Leading 0
                                            }
                                            var thisYear = arg._d.getYear() + 1900;   // Years are 1900 based

                                            var thisCompare = thisMonth + "/" + thisDate + "/" + thisYear;
                                            console.log(thisCompare);

                                            if ($.inArray(thisCompare, disabledArr) != -1) {

                                                return arg._pf = {userInvalidated: true};
                                            }
                                        }

                                    }).focus();

                                    $(document).ready(function () {
                                        $(".daterangepicker").hide();
                                    });

                                </script>

                                <script src="{{ asset("js/admin/bootstrap-multiselect.js") }}"
                                        type="text/javascript"></script>
                                <link rel="stylesheet" href="{{ asset("css/bootstrap-multiselect.css") }}"/>

                                <script>
                                    $('#tutor_assign').multiselect({
                                        nonSelectedText: 'Select Tutor',
                                        enableFiltering: true,
                                        enableCaseInsensitiveFiltering: true,
                                        buttonWidth: '500px'
                                    });
                                </script>
    @endpush
@stop
