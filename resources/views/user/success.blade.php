<div>
    <h2>🎉 Payment Successful!</h2>
    <p>Your ad <strong>{{ $product->title }}</strong> is being upgraded to Premium.</p>

    <div id="status-box">
        Checking payment status...
    </div>

    <script>
        async function checkPremium() {
            let response = await fetch("{{ route('payment.check', $product->id) }}");
            let data = await response.json();

            if (data.is_premium === 1) {
                document.getElementById("status-box").innerHTML = 
                    "<span style='color: green;'>✅ Your ad is now Premium!</span>";
            } else {
                setTimeout(checkPremium, 3000); // check again after 3s
            }
        }

        // start polling
        checkPremium();
    </script>
</div>
