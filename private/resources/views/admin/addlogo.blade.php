@extends('layouts.admin.dashboard')
@section('page_heading','Logo List')
@section('section')
@include('message.message')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="add-buttton mb-3">
    <a href="#" id="addLang" class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-plus-circle"
            aria-hidden="true"></i> Add Logo</a>
</div>

<div class="row">
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Logo</th>
                    <th>Company Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logos as $key=>$logo)
                <tr>
                    <td>{{$count++}}</td>
                    <td><image src="../images/company_logo/{{$logo->image}}" style="width:10%"></td>
                    <td>{{$logo->company_name}}</td>
                    <td><a href="#" data-index="{{$logo->id}}" data-index1="{{$logo->company_name}}" data-index2="{{$logo->image}}" name="tab" data-toggle="modal" data-target="#myModal"
                            class="btn btn-square btn-option3 btn-icon wdth red_btn" id="tab"><i class="fa fa-edit"></i></a>
                    </td>
                    <td>{!! '<a href="#" data-index="'.$logo->id.'" name="logo_del"
                            class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-trash"></i></a>'
                        !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Logo</th>
                    <th>Company Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Logo</h4>
            </div>
            <div class="modal-body">
                <form class="language-modal" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-grup ">
                                <label class="control-label " for="title">
                                    Company Name
                                </label>
                                <input class="form-control" required id="company_name" name="company_name" type="text"
                                    placeholder="Company Name">
                                <input id="nameCheck" hidden name="nameCheck" type="text">  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-grup " style="text-align:center">
                                <img style="width:100px;height:100px;background-color:#e0e0eb" src="" alt="Plan Image" class="uploadpreview" id="preview">
                                <div class="form-grup " style="padding-top:20px">
                                    <input class="uploadfile" type="file" name="file" id="file" style="width: 100px;position: absolute;display: none;">
						            <a class="btn" id="upload_btn"><i class="fa fa-cloud-upload"></i> Choose image</a>
                                    <p style="padding-top: 10px">Upload .JPG or .PNG image.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                   
                    <div class="row" style="padding-top:20px">
                        <div class="col-md-6">
                            <button class="btn w-100" id="submitLang" name="submit" type="button">Submit</button>
                        </div>
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
    $(document).ready(function () {
        $('#example').DataTable();
    });
    $("#addLang").on("click", function () {
        $('#company_name').val('');
        document.getElementById("preview").src = '../web/images/default.png'
        $('#myModal').modal("toggle");
    });

    $("a[name=logo_del]").on("click", function () {

        var answer = confirm('Are you sure you want to delete Logo?');
        if (!answer) {
            return 0;
        }

        $.ajax({
            type: 'DELETE',
            url: "{{url('/admin/logo/')}}" + '/' + $(this).data("index"),
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                location.reload();
            }
        });
    });

    $("a[name=tab]").on("click", function () {
        $('#company_name').val($(this).data("index1"));
        document.getElementById("preview").src = '../images/company_logo/' + $(this).data("index2");
        $('#nameCheck').val($(this).data("index"));

    });

    $(document).on('click', '#submitLang', function () {

        if ($('#nameCheck').val() == '') {
            var type = 'POST';
            var url = "{{url('/admin/logo')}}";
            var form_data = new FormData();
            var file = $("#file").prop("files")[0];
            form_data.append('file', file);
            form_data.append('company_name', $('#company_name').val());
            form_data.append('_token', $('input[name=_token]').val());

        } else {
            var type = 'POST';
            var url = "{{url('/admin/logo/')}}" + '/' + $('#nameCheck').val();
            var form_data = new FormData();
            var file = $("#file").prop("files")[0];
            form_data.append('file', file);
            form_data.append('company_name', $('#company_name').val());
            form_data.append('_token', $('input[name=_token]').val());
        }

        $.ajax({
            type: type,
            url: url,
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            
            success: function (data) {
                var data = JSON.parse(data);
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


    $("#upload_btn").on('click',function(){
		$(".uploadfile").trigger('click');
	});
	$(".uploadfile").on('change',function(){
		$('.uploadpreview').src="";
		readURL(this, "uploadpreview");
	});
	function readURL(input, f) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('.' + f).attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

</script>

@endpush
@stop