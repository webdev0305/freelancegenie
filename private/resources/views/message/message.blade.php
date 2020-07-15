   @if(Session::has('success'))
       <div class="bs-example">
           <div class="alert alert-info">
               <a href="#" class="close" data-dismiss="alert">&times;</a>
               {{ Session::get('success') }}
           </div>
       </div>


    @endif 
 
    @if(Session::has('error'))
        <div class="bs-example">
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                {{ Session::get('error') }}
            </div>
        </div>
    @endif 
