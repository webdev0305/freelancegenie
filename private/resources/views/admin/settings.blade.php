@extends('layouts.admin.dashboard')

@section('page_heading','Settings')

@section('section')

    @include('message.message')

    <div class="row">
    <div class="col-md-6">

            <div class="form-wrap">

                @foreach($settings as $setting)
                <div class="form-group">

                    <label for="disabledSelect">{{$setting->label}}</label>
                    <div class="row fields">
                        <div class="col-md-9 col-sm-9">

                            <input name="{{$setting->name}}" value="{{$setting->value}}" class="form-control" type="text">
                         
                            @if ($errors->has('admin_email'))

                                <span class="help-block">

                                        <strong>{{ $errors->first('admin_email') }}</strong>

                                    </span>

                            @endif

                        </div>
                        <div class="col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-primary update">Update</button>

                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            

        </div> 

    </div>



@stop
@push('scripts')
<script type="text/javascript">
$('.update').click(function(){
   var value=$(this).closest('.fields').find('input').val(); 
   var name=$(this).closest('.fields').find('input').attr('name');
   $.ajax({
    type:'post',
    url:'{{url("/admin/settings/update")}}',
    data:{'_token':'{{csrf_token()}}','name':name,'value':value}
   }).success(function(result){
        console.log(result);
        window.location.reload();
   });
});
</script>
@endpush

