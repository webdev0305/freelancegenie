@extends('layouts.admin.dashboard')

@section('page_heading','Settings')

@section('section')

@include('message.message')

<div class="row">
    <div class="col-md-6">
        <div class="form-wrap">
            @foreach($settings as $setting)
            <div class="form-group">
                @if ($setting->name != 'newsletter')
                <label for="disabledSelect">{{$setting->label}}</label>
                <div class="row fields">
                    <div class="col-md-9 col-sm-9">
                        <input name="{{$setting->name}}" value="{{$setting->value}}" class="form-control" type="text">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-primary update">Update</button>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
            
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-wrap">
            <div class="form-group">
                <label for="disabledSelect">Google Analytics</label>
                <div class="row fields">
                    <div class="col-md-9 col-sm-9">
                        <input name="google_analytics" value="https://accounts.google.com" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <a href="https://accounts.google.com" target="_blank" class="btn btn-primary" style="height:38px;width:107.15px"><i class="fa fa-link"></i> Link</a>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="disabledSelect">{{$newsletter->label}}</label>
                <div class="row fields">
                    <div class="col-md-9 col-sm-9">
                        <select name="{{$newsletter->name}}" class="form-control" >
                            <option value="1" {{$newsletter->value==1? 'selected':''}}>Enabled</option>
                            <option value="0" {{$newsletter->value==0? 'selected':''}}>Disabled</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-primary " id="newsletter_update">Update</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="disabledSelect">{{$certificate->label}}</label>
                <div class="row fields">
                    <div class="col-md-3 col-sm-3">
                        <input name="{{$certificate->name}}" value="{{$certificate->value}}" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="file" name="file" class="btn">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-primary" id="cer_image_update">Update</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="disabledSelect">{{$sign->label}}</label>
                <div class="row fields">
                    <div class="col-md-3 col-sm-3">
                        <input name="{{$sign->name}}" value="{{$sign->value}}" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="file_sign" name="file_sign" class="btn">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-primary" id="sign_image_update">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@push('scripts')
<script type="text/javascript">
    $('.update').click(function () {
        var value = $(this).closest('.fields').find('input').val();
        var name = $(this).closest('.fields').find('input').attr('name');
        $.ajax({
            type: 'post',
            url: '{{url("/admin/settings/update")}}',
            data: {
                '_token': '{{csrf_token()}}',
                'name': name,
                'value': value
            }
        }).success(function (result) {
            console.log(result);
            window.location.reload();
        });
    });
    $('#newsletter_update').click(function () {
        var value = $(this).closest('.fields').find('select').val();
        var name = $(this).closest('.fields').find('select').attr('name');
        
        $.ajax({
            type: 'post',
            url: '{{url("/admin/settings/update")}}',
            data: {
                '_token': '{{csrf_token()}}',
                'name': name,
                'value': value
            }
        }).success(function (result) {
            console.log(result);
            window.location.reload();
        });
    });

    $('#cer_image_update').click(function () {
        var type = 'POST';
        var url = "{{url('/admin/settings/update_certificate')}}";
        var form_data = new FormData();
        var file = $("#file").prop("files")[0];
        form_data.append('file', file);
        form_data.append('_token', $('input[name=_token]').val());
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
                    location.reload();
                }
            }
        });
    });

    $('#sign_image_update').click(function () {
        var type = 'POST';
        var url = "{{url('/admin/settings/update_sign')}}";
        var form_data = new FormData();
        var file = $("#file_sign").prop("files")[0];
        form_data.append('file', file);
        form_data.append('_token', $('input[name=_token]').val());
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
                    location.reload();
                }
            }
        });
    });
</script>
@endpush