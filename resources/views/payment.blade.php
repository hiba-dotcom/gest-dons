<!DOCTYPE html>
<html>
<head>
    <title>Paiement</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif

<form action="{{ route('payment.process') }}" method="POST" id="payment-form">
    @csrf
    <div id="card-element"></div>
    <button type="submit">Payer 10€</button>
</form>

<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const {token, error} = await stripe.createToken(card);
        if (error) {
            alert(error.message);
        } else {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'stripeToken';
            input.value = token.id;
            form.appendChild(input);
            form.submit();
        }
    });
</script>
</body>
</html>
