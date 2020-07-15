@extends('layouts.admin.dashboard')
@section('page_heading','Job List')
@section('section')
    @include('message.message')

    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-bordered" id="users-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                             <th>Employer Name</th>
                            <th>Created At</th>
                           <th>Actions</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
	<!-- Modal -->
<div class="modal fade maiilModal" id="rating_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rating for the job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                       
						<p><span class="rating_no"></span><img id="rating_img" src=""></p>
						<p id="comment"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
	<!-- Modal -->
<div class="modal fade maiilModal" id="dbs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Check DBS Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                        <p>Below are the details to check the DBS record of the tutor.</p>
						
						Organisation name: <input type="text" readonly id="dbs_organisation" name="dbs_organisation" value="kk group"><br><br>
                        Forename: <input type="text" readonly id="dbs_forename" name="dbs_forename" value="krishan"><br><br>
						Surname: <input type="text" readonly id="dbs_surname" name="dbs_surname" value="Baghel">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="https://secure.crbonline.gov.uk/crsc/check" target="_blank" class="btn btn-secondary" data-method="delete" style="cursor:pointer;">Go
                       
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade maiilModal" id="update_register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Students Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				
                <div id="student_body" class="modal-body">
                    <table id="example" class="inuse table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr><th>First Name</th><th>Surname</th></tr>
                        <tbody id="first"></tbody>
                    </thead>

                    </table>
				</div>
				
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
	
	
    @push('scripts')
        <script>
		$("#users-table").on('click','.dbs',function(){
           // $('#title-error').html("");
          var ids = $(this).data('id');
		  //alert(ids);
		   
          //$("#tutor_id").val(ids);
            $.ajax({
                type: 'GET',
				url: "{{url('/employer/check_dbs/')}}"+'/'+ids,
                data: {//tutorid:ids,

                },
                success: function (data) {
				//alert('successful');
				console.log(data);
				var res=JSON.parse(data);
				console.log(res.tutor_profile.updatesid);
				//$("#sid").val(res.tutor_profile.updatesid);
				$("#dbs_forename").val('');
				$("#dbs_surname").val('');
				$("#dbs_organisation").val('');
				$("#dbs_forename").val(res.tutor_profile.dbs_forename);
				$("#dbs_surname").val(res.tutor_profile.dbs_surname);
				$("#dbs_organisation").val(res.tutor_profile.dbs_organisation);
                }

            });

            //$('#myModal').modal('show');

        });
            $(document).ready(function () {
                oTable = $('#example').DataTable({
				"dom": 'Bfrtip',
				//"buttons": [ 'excel', 'pdf', 'print'],
				"buttons": [ 'excel','print'],
                   
                });
           
                oTable = $('#users-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ url('/admin/view_jobs') }}",
                    "columns": [
                        { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                        {data: 'title', name: 'title'},
                         {data: 'employer.first_name', name: 'employer.first_name'},
                        {data: 'created_at', name: 'created_at'},
                       {data: 'actions', name: 'actions', orderable: false, searchable: false}


                    ]
                });

            });

            //Delete table
            $(document).on('click', '#job_del', function () {
                var answer = confirm('Are you sure you want to delete job ?');
                if (!answer) {
                    return 0;
                }
                 $.ajax({
                    type: 'DELETE',
                    url: "{{url('/admin/job/')}}" + '/' + $(this).data("index"),
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        location.reload();
                    }
                });
            });
			$("#users-table").on('click','.view_rating',function(){ // Click to only happen on announce link
           // $('#title-error').html("");
			var ids = $(this).data('id');
		  //var ids = 88;
		  //alert(ids);
		   
          //$("#tutor_id").val(ids);
            $.ajax({
                type: 'GET',
				url: "{{url('/admin/view_rating/')}}"+'/'+ids,
                data: {//tutorid:ids,

                },
                success: function (data) {
				
				console.log(data);
				var res=JSON.parse(data);
				//alert(res);
				console.log(res[0].comment);
				//$("#sid").val(res.tutor_profile.updatesid);
				$("#comment").text('');
				$(".rating_no").text('');
				$('#rating_img').attr('src','');
				//$("#dbs_surname").val('');
				
				$("#comment").text(res[0].comment);
				$('#rating_img').attr('src',res[0].star_img);
				$(".rating_no").text(res[0].rating);
				//$("#dbs_surname").val(res.tutor_profile.dbs_surname);
				
                }

            });

            //$('#myModal').modal('show');

        });
        $("#users-table").on('click','.update_register_btn',function(){
           // $('#title-error').html("");
			var ids = $(this).data('id');
            //$('.inuse').attr('id',ids);
		  $('#first').html('');
          var table = $('#example').DataTable();
                             table
                                .clear()
                                .draw();
          //alert('here');
        
		 //event.preventDefault();
          $('#job_students').val($(this).data('id'));
          $.ajax({
                type: "POST",
                url: "{{url('/admin/students_data')}}",
				data: {"_token": "{{ csrf_token() }}",jobid:$(this).data('id')},
                success: function (data) {
                    if (data.errors) {
                        
                        //oTable = $('#example').DataTable();
                        
                        //oTable.destroy();
				/*oTable = $('#example').DataTable({
				"dom": 'Bfrtip',
				//"buttons": [ 'excel', 'pdf', 'print'],
				"buttons": [ 'excel','print'],
                   
                });*/

                    }
					if (data.success) {
                    //alert('ok');
                        var obj=data.student;
                        //alert(obj);
                        console.log(data);
                        //alert(data.student[0].stuname);
                        var table = $('#example').DataTable();
                        $.each( obj, function( key, value ) {
                            table.row.add( {
                                "0":       value["stuname"],
                                "1":   value["rollno"],
                            } ).draw();
                          });
                          
                          
 

                          
                         
                
                
						
                    }
                   
                }
            });
            /*oTable = $('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    ajax:{
                type: "POST",
                url: "{{url('/admin/students_data')}}",
				data: {"_token": "{{ csrf_token() }}",jobid:$(this).data('id')},
                },
                    "columns": [
                        { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                        {data: 'job_id', name: 'job_id'},
                        {data: 'created_at', name: 'created_at'},
                       {data: 'actions', name: 'actions', orderable: false, searchable: false}
                         //{data: 'Roll No.', name: 'employer.first_name'},
                       ]
                });*/
        });
        </script>
    @endpush
@stop
