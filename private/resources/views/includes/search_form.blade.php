<form class="form-inline" method="get" action="tutors">

    <div class="form-group ">
        <select class="form-control" name="disciplines[]"  id="disciplines" onchange="fetch_select(this.value);">
				<option value="">Select Type</option>
                 @foreach($disciplines as  $discipline)
                     @if(isset($discipline->childrenDisciplines['0']))
                         <optgroup label="<?php echo $discipline->name;?>"
                                   data-max-options="1" discipline_id="{{$discipline->id}}">
                             @foreach($discipline->childrenDisciplines as  $disciplineChild)
                                 <option value="{{$disciplineChild->id}}"  {{ !empty(\Input::get('disciplines')) ? in_array($disciplineChild->id , \Input::get('disciplines'))   ? 'selected="selected"' : '' : ''}}>{{$disciplineChild->name}}</option>                                                                            
							@endforeach
							</optgroup>
                     @endif
                 @endforeach
				 
        </select>
    </div>

    <div class="form-group " id="sp">
	
        <select class="form-control" name="specialist[]" id="specialist"> /* to show selected category on inner search form */
			@if(!empty(\Input::get('specialist')))
            @foreach($categories as  $categorieItem)
                @if(isset($categorieItem->children['0']))
                    <optgroup label="{{$categorieItem->name}}"
                              data-max-options="1">
                        @foreach($categorieItem->children as  $categorieChild)
                            <option value="{{$categorieChild->id}}" {{ !empty(\Input::get('specialist')) ? in_array($categorieChild->id , \Input::get('specialist'))   ? 'selected="selected"' : '' : ''}} >{{$categorieChild->name}}</option>
                        @endforeach
                        @endif
                        @endforeach
                    </optgroup>
			@endif		
        </select>
    </div>

    <div class="form-group ">
        <select class="form-control" name="level[]"  id="level" multiple="">
             @foreach($levels as  $level)
                @if(isset($level->childrenLevels['0']))
                    <optgroup label="{{$level->level}}"
                              data-max-options="1">
                        @foreach($level->childrenLevels as  $levelChild)
                            <option value="{{$levelChild->id}}" {{ !empty(\Input::get('level')) ? in_array($levelChild->id , \Input::get('level'))   ? 'selected="selected"' : '' : ''}} >{{$levelChild->level}}</option>                                                                            @endforeach
                @endif
            @endforeach
			</optgroup>
        </select>
    </div>

    <div class="form-group ">

    <select class="form-control" name="location[]" id="location" multiple="">
        @foreach($countrys as  $country)
            @if(isset($country->children['0']))
                <optgroup label="{{$country->name}}"
                          data-max-options="1">
                    @foreach($country->children as  $categorieChild)
                        <option value="{{$categorieChild->id}}" {{ !empty(\Input::get('location')) ? in_array($categorieChild->id , \Input::get('location'))   ? 'selected="selected"' : '' : ''}}>{{$categorieChild->name}}</option>
                    @endforeach
                    @endif
                    @endforeach
                </optgroup>
    </select>
    </div>
	<!--<div class="form-group ">

		<select class="form-control" name="zip[]" id="zip" multiple="">
			<optgroup label="Select Postcode" data-max-options="1">
				@foreach($tutor_profiles as  $tutor_profile)
				@if(isset($tutor_profile->zip))
					<option value="{{$tutor_profile->zip}}" {{ !empty(\Input::get('zip')) ? in_array($tutor_profile->zip , \Input::get('zip'))   ? 'selected="selected"' : '' : ''}}>{{$tutor_profile->zip}}</option>
				@endif
				@endforeach
			</optgroup>
		</select>
    </div>
	 -->
    <button type="submit" class="btn btn-primary " id='find'><i class="fas fa-search"></i>Find</button>
</form>

    @push('scripts')
        <script>
    $(document).ready(function () {
    $('#find').click(function(e){
    if(!$('#location').val()){	$('#validation').text('Please Select Location of Tutor');	$('#form_validation').modal('show');   e.preventDefault();    }	if(!$('#sp #specialist').val()){	$('#validation').text('Please Select Specialism of Tutor');	$('#form_validation').modal('show');   e.preventDefault();    }
    if(!$('#disciplines').val()){	$('#validation').text('Please Select Type of Tutor');	$('#form_validation').modal('show');
   e.preventDefault();
    }
    
    
    });
         

        $('#disciplines').multiselect({
            nonSelectedText: 'Select Type',
            enableFiltering: true,
			multiselect:false,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });

        $('#level').multiselect({
            nonSelectedText: 'Select Level',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });

        $('#location').multiselect({
            nonSelectedText: 'Select Location',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px',
            required:true
        });
		$('#zip').multiselect({
            nonSelectedText: 'Select Postcode',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });
         $('#sp #specialist').multiselect({
            nonSelectedText: 'Select Specialism',
            enableFiltering: true,
			multiselect:false,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });
    });
	function fetch_select(val) {
    //alert('ok');
//const selectMembers = $("#specialist");
  //  selectMembers.empty();
            $.ajax({
                type: 'POST',
                url: "{{url('/tutors/get_option')}}",
                data: {
                    get_option: val,page:'search_form',
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
				//selectMembers.append(response.categories);
                //alert('here');
                $('#sp').html(response);
                $('#sp #specialist').multiselect({
            nonSelectedText: 'Select Specialism',
            enableFiltering: true,
			multiselect:false,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '500px'
        });
                console.log(response);
               //$('#specialist').html(response.categories);
				//$('#specialist').multiSelect('refresh');
				//alert(response.categories);
				//document.getElementById("specialist").innerHTML = '';
				//document.getElementById("sp").innerHTML = '';
				//document.getElementById("sp").innerHTML = response;
				//document.getElementById("specialist").innerHTML = response;
				//document.getElementById("specialist").innerHTML = response.categories;
				//$('#sp ul').append(response.spl);
				//document.getElementById("sp").ul.innerHTML = response.sp;
                    /*if (response.status == '0') {
                        document.getElementById("specialist").innerHTML = '<option value="">Specialist</option>';
                      
                    } else {
                        document.getElementById("specialist").innerHTML = response.categories;
                       
                    }*/
                }

            });


        }
</script>
@endpush