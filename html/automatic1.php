<!-- Include Razorpay Checkout Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
            "key": "<?php echo $data['key']?>",
            "amount": "<?php echo $data['amount']?>",
            "currency": "INR",
            "name": "<?php echo $data['name']?>",
            "description": "<?php echo $data['description']?>",
            "image": "<?php echo $data['image']?>",
            "order_id": "<?php echo $data['order_id']?>",
            "prefill": {
                "name": "<?php echo $data['prefill']['name']?>",
                "email": "<?php echo $data['prefill']['email']?>",
                "contact": "<?php echo $data['prefill']['contact']?>"
            },
            "notes": {
                "buyer_name": "<?php echo $data['buyer_name']?>",
                "email": "<?php echo $data['prefill']['email']?>",
                "phone": "<?php echo $data['prefill']['contact']?>",
                "product": "<?php echo $data['name']?>"
            },
            "theme": {
                "color": "#3399cc"
            },
            "handler": function (response) {
                // Show processing message before redirection
                document.body.innerHTML = `
                    <div style="text-align:center; padding: 50px;">
                        <h2>Processing Your Payment...</h2>
                        <p>Please wait while we verify your transaction.</p>
                        <img src="./assets/images/loading-payment.gif" width="50" alt="Loading...">
                    </div>
                `;
                // Payment successful - Redirect to verification page
                window.location.href = "verify1.php?payment_id=" + response.razorpay_payment_id + "&&payment_signature=" +response.razorpay_signature;
            },
            "modal": {
                "ondismiss": function () {
                    // Razorpay modal closed - Redirect to homepage
                    window.location.href = "https://www.eduxoncabs.com/";
                }
            }
        };

        // Ensure Razorpay script is loaded before calling Razorpay
        if (typeof Razorpay !== "undefined") {
            var rzp = new Razorpay(options);

            // Automatically trigger Razorpay checkout
            setTimeout(function () {
                rzp.open();
            }, 500);

            // Hide the default Razorpay button if it exists
            let paymentButton = document.querySelector(".razorpay-payment-button");
            if (paymentButton) {
                paymentButton.style.display = "none";
            }
        } else {
            console.error("Razorpay script not loaded. Please check the script source.");
        }
    });
</script>
