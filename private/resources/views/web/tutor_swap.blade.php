@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Tutor Dashboard')
<section class="inner-page-title">
    <div class="container" id="date-range12-container">
        <h2>Swap Requests</h2>
    </div>
</section>
<section class="inner-cotent">
    <div class="container">
        @include('message.message')
		<?php //echo '<pre>';print_r($jobs);echo '</pre>';?>       
		<!-- Trigger the modal with a button -->
        <table id="example" class="table table-striped table-bordered table-responsive-lg" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
				<th>Tutor Email</th>
                <th>Job Title</th>
				<th>Requested On</th>
                <th>Action</th>
			</tr>
            </thead>
            <tbody>
			@php ($i = 1)
             @foreach($tutor_request as $key=>$request)
				<tr>
                    <td>{{$i}}</td>
					<td>{{$request->User->email}}</td>
                    <td><a target="_blank" href="swap_detail/{{$request->job_id}}">{{$request->Jobs->title}}</a></td>
					<td>{{date('d-m-Y',strtotime($request->created_at))}}</td>
					<td><button type="button" class="swap btn btn-primary float-left mr-1" data-job_id="{{$request->job_id}}" data-id="{{$request->id}}"  data-tutor_assign="{{$request->to_tutor_id}}"  data-toggle="modal" data-target="#deleteMerchant">Accept
                        </button>
					</td>
				</tr>
				@php ($i++)
               
				
            @endforeach

            </tbody>

        </table>
    </div>			
	
	
</section>
	
@push('scripts')
<script>
$(document).ready(function () {
            //$('#example').DataTable();
			oTable = $('#example').DataTable({
				//"dom": 'Bfrtip',
				//"buttons": [ 'excel', 'pdf', 'print'],
				//"buttons": [ 'excel','print'],
                });
			$('.swap').on("click", function (event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#title-error').html("");

            $.ajax({
                type: "POST",
                url: "{{url('/tutor/swap_user')}}",
                data: {"_token": "{{ csrf_token() }}",job_id:$(this).data('job_id'),swap_id:$(this).data('id'),tutor_assign:$(this).data('tutor_assign')},
                success: function (data) {
                    if (data.errors) {
                        $('#title-error').html(data.errors);

                    }

                    if (data.success) {
                        bootoast.toast({
                            message: data.message
                        });
                        // $('#myModal').modal('toggle');
                        location.reload();
                    }
                }
            });
            event.preventDefault();
        });
});
</script>
@endpush
@stop