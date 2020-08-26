@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Payment')

<section class="inner-page-title">
	<div class="container">
		<h2>Payment</h2>
	</div>
</section>

<section class="inner-cotent">
	<div class="container">
		<div class="form-wrap">
			@include('message.message')
			<br>
			<div id="paid_form">
				<div class="row payment_row">
					<div class="col-md-6 col-lg-6 col-sm-6">
						<div class="pymnt_optns">
							<div class="pymnt_optns1 cs_py">
								<i class="far fa-credit-card"></i>
								<div class="cstm-bc-cntr">
									<label class="radio">
										<a type="radio" name="py_slct" value="credit"
											class="chk_py" checked="" >CREDIT/DEBIT CARD
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-6 col-sm-6">
						<div class="pymnt_optns2 cs_py">
							<i class="fas fa-money-check-alt"></i>
							<div class="cstm-bc-cntr">
								<label class="radio">
									<input type="radio" name="py_slct" value="bank"
										class="chk_py">BANK TRANSFER
								</label>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-6 col-sm-6">
						<br>
						<p style="color:#e8058e;font-size: 13px;text-align: center;">Gain Instant Access</p>
					</div>
					<div class="col-md-6 col-lg-6 col-sm-6">
						<p style="color:#e8058e;font-size: 13px;text-align: center;">Access can be delayed by 3 days due to your payment method</p>
					</div>
				</div>
			</div>

            <div class='form-row'style="padding-top: 10px;">
                <div class='col-md-12'>
                    <a class='form-control w-100 text-center btn btn-primary submit-button' href="" >Pay >></a>
                </div>
            </div>
		</div>
        
	</div>

</section>



@stop