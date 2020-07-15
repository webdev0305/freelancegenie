@extends('layouts.admin.dashboard')
@section('page_heading','Invoice List')
@section('section')
@include('message.message')
    <div class="row">
	
        <div class="col-sm-12">
          

                    <table class="table table-bordered" id="example">
                        <thead>
                        <tr>
						<th></th>
                            <th>Booking Id</th>
							<th>Invoice No.</th>
							<th>Booking Dates</th>
                            <th>Total Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($invoice as $key=>$invoice)
                        <tr>
                            <td></td>
                            <td class='clickable-row' data-href="../admin/view_invoice/{{$invoice['id']}}">{{$invoice['id']}}</td>
							<td class='clickable-row' data-href="../admin/view_invoice/{{$invoice['id']}}">{{$invoice['invoice_no']}}</td>
							<td class='clickable-row' data-href="../admin/view_invoice/{{$invoice['id']}}">{{$invoice['date']}}</td>
							<td class='clickable-row' data-href="../admin/view_invoice/{{$invoice['id']}}">{{'£'.$invoice['total']}}</td>
                        </tr>
                        
					@endforeach
					
                        </tbody>
                    </table>
        </div>
    </div>
	
    @push('scripts')
        <script>
		$(document).ready(function () {
	var table = $('#example').DataTable({
		dom: 'Blfrtip',
		buttons: ['excel','selectAll', 'selectNone',{
					text: 'Send Invoice',
					action: function ( e, dt, node, config ) {
						Send_Invoice();
					}
				} ],
		language: {
			buttons: {
				selectAll: "Select all invoices",
				selectNone: "Select none",
				excel: "Download Excel"
			}
		},
		columnDefs: [{
			orderable: false,
			className: 'select-checkbox',
			targets: 0
		}],
		select: {
			style: 'os',
			selector: 'td:first-child'
		},
		order: [
			[1, 'asc']
		]
	});
	

	function Send_Invoice() {
		var ids = $.map(table.rows('.selected').data(), function (item) {
			return item[1]
		});
		$.ajax({
			type:"POST",
			url:"{{url('admin/invoice_to_accountant')}}",
			data:{"_token":"{{csrf_token()}}",ids:ids},
			success:function(data){
				//console.log(data);
				if(data.success){
                        location.reload();
				}
			}
		});
		//console.log(ids); alert(table.rows('.selected').data().length + ' row(s) selected');
	};
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
		</script>
		
    @endpush
@stop
