@extends('layouts.admin.dashboard')
@section('page_heading','Employer List')
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
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                oTable = $('#users-table').DataTable({
					"dom": 'Bfrtip',
					"buttons": [ 'excel','print'],
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ url('/admin/view_employer') }}",
                    "columns": [
                        { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                        {data: 'email', name: 'email'},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'phone', name: 'phone'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false}
                        // {data: 'action', name: 'action'},


                    ]
                });			


                $(document).on('click', '#activateTutor', function () {
                    var answer = confirm('Are you sure you want to activate/deactivate ?');
                    if (!answer)
                    {
                        return 0;
                    }

                    $.ajax({
                        type: 'post',
                        url: "{{url('/admin/activate_users')}}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id': $(this).val()
                        },
                        success: function (data) {
                            oTable.ajax.reload();
                          }
                    });
                });
				$(document).on('click', '#activateOnAccount', function () {
                    var answer = confirm('Are you sure you want to enable/disable On Account for this employer ?');
                    if (!answer)
                    {
                        return 0;
                    }

                    $.ajax({
                        type: 'post',
                        url: "{{url('/admin/activate_onaccounts')}}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id': $(this).val()
                        },
                        success: function (data) {
                            oTable.ajax.reload();
                          }
                    });
                });
            });
        </script>
    @endpush
@stop
