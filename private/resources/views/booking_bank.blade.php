<script src="https://js.stripe.com/v3/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<button id="checkout-button" style="display:none">Checkout</button>
<script>
	var session = '<?php echo $sessionid; ?>';
	var stripe = Stripe('pk_test_JspMJwlo1veVAnX7h3u65QSZ008USAKRAR');
	var checkoutButton = document.getElementById('checkout-button');

	checkoutButton.addEventListener('click', function() {
		stripe.redirectToCheckout({
			sessionId: session
		}).then(function (result) {
		});
	});
	$(document).ready(function(){
		$('#checkout-button').click();
	})
</script>