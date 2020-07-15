@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <span class="close" data-dismiss="alert">&times;</span>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif