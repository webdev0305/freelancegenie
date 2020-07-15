@extends('layouts.admin.dashboard')
@section('page_heading','Language List')
@section('section')
    @include('message.message')
	<div class="add-buttton mb-3">
    <a href="#" id="addLang" class="btn btn-square btn-option3 btn-icon wdth red_btn"><i
                class="fa fa-plus-circle" aria-hidden="true"></i> Add Language</a>
	</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($languages as $key=>$language)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$language->name}}</td>
                                <td>{!! '<a   href="#" data-index="'.$language->name.'" name="tab" data-toggle="modal" data-target="#myModal" class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-edit"></i></a>' !!}</td>
                                <td>{!! '<a   href="#" data-index="'.$language->id.'" name="lang_del"  class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-trash"></i></a>' !!}</td>
                            </tr>
                        @endforeach

                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Language</h4>
                </div>
                <div class="modal-body">
                    <form class="row language-modal" action="" method="post">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-grup ">
                                <input class="form-control" id="nameLang" name="nameLang" type="text" placeholder="Language Name">
                                <input id="nameCheck" hidden name="nameCheck" type="text">
                            </div>
                        </div>
						<div class="col-md-6 col-sm-6">
							<button class="btn w-100" id="submitLang" name="submit" type="button">Submit</button>
						</div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
            $("#addLang").on("click", function () {
                $('#nameLang').val('');
                $('#nameCheck').val('');
                $('#myModal').modal("toggle");
            });
            //Delete table

            $("a[name=lang_del]").on("click", function () {

                var answer = confirm('Are you sure you want to delete language ?');
                if (!answer) {
                    return 0;
                }

                $.ajax({
                    type: 'DELETE',
                    url: "{{url('/admin/language/')}}" + '/' + $(this).data("index"),
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        location.reload();
                    }
                });
            });

            $("a[name=tab]").on("click", function () {
                var a = $(this).data("index");
                $('#nameLang').val(a);
                $('#nameCheck').val(a);

            });

            $(document).on('click', '#submitLang', function () {

                if ($('#nameCheck').val() == '') {
                    var type = 'POST';
                    var url = "{{url('/admin/language')}}"
                } else {
                    var type = 'PUT';
                    var url = "{{url('/admin/language/')}}" + '/' + $('#nameCheck').val();
                }

                $.ajax({
                    type: type,
                    url: url,
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'nameLang': $('#nameLang').val()
                    },
                    success: function (data) {
                        if (data.success == '0') {
                            alert(data.errors);
                        }
                        if (data.success == '1') {
                            $('#myModal').modal("toggle");
                            location.reload();
                            //alert(data.errors);
                        }
                    }
                });
            });
        </script>

    @endpush
@stop
