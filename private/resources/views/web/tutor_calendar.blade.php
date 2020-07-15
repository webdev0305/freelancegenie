@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Tutor Dashboard')
<link rel="stylesheet" href="{{ asset('assets/web/scripts/jquery-ui/jquery-ui.min.css') }}" />
<style>
td.off.disabled {
    background: mediumspringgreen !important;
    color: #fff !important;
    font-size: 18px !important;
    cursor: context-menu !important;
    text-decoration: overline !important;
}
.highlight a{
  background-color: #29f274 !important;
  color: #ffffff !important;
}
</style>
<section class="inner-page-title">
    <div class="container">
        <h2>My Calendar</h2>
    </div>
</section>
<section class="inner-cotent">
    <div class="container" id="date-range12-container">
        @include('message.message')
        <div class="row" id='md'>
        </div>
    </div>
	
</section>


@push('scripts')
<script src="{{ asset('assets/web/scripts/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<script>
var naArray = ["20190622", "20190623", "20190625"];
function isDateAvailable(date){
    return naArray.indexOf(date.format('YYYYMMDD')) > -1;
}

/*$( function() {
 $(md).datepicker({
            //minDate: new Date(),
                
                locale: {
                    format: 'M/DD/Y hh:mm A'
                },
                inline:true,
                container: '#date-range12-container',
                alwaysOpen:true,
              //isInvalidDate: function(date) {
               // var disabled_start = moment('05/10/2019', 'MM/DD/YYYY');
                //var disabled_end = moment('05/15/2019', 'MM/DD/YYYY');
                //return date.isAfter(disabled_start) && date.isBefore(disabled_end);
                
              //}
              isInvalidDate: isDateAvailable,
              
            });
            
            
            
           });*/
           /*$("#date").datepicker({
            
            beforeShowDay: function(date){
            var array = ["2019-05-14","2013-03-15","2013-03-16"];
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [ array.indexOf(string) == -1 ]
            } 
            });*/
            // An array of highlighting dates ( 'dd-mm-yyyy' )

           // An array of highlighting dates ( 'dd-mm-yyyy' )
var highlight_dates = ['20-5-2019','11-1-2018','18-1-2018','28-1-2018'];
 
$(document).ready(function(){
 
 // Initialize datepicker
 $('#md').datepicker({
  beforeShowDay: function(date){
   var month = date.getMonth()+1;
   var year = date.getFullYear();
   var day = date.getDate();
 
   // Change format of date
   var newdate = day+"-"+month+'-'+year;

   // Set tooltip text when mouse over date
   var tooltip_text = "You have booking on " + newdate;

   // Check date in Array
   if(jQuery.inArray(newdate, highlight_dates) != -1){
    return [true, "highlight", tooltip_text ];
   }
   return [true];
  }
 });
});
       
           
</script>
@endpush
@stop