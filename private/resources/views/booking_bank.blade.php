<script src="https://js.stripe.com/v3/"></script>

<script>
	alert('ok');
	var session = '<?php echo $sessionid; ?>';
	alert(session);
	var stripe = Stripe('pk_test_JspMJwlo1veVAnX7h3u65QSZ008USAKRAR');
	var checkoutButton = document.getElementById('checkout-button');

	checkoutButton.addEventListener('click', function() {
	stripe.redirectToCheckout({
		
		sessionId: <?php echo $sessionid; ?>
	}).then(function (result) {
		// If `redirectToCheckout` fails due to a browser or network
		// error, display the localized error message to your customer
		// using `result.error.message`.
	});
	});
</script>