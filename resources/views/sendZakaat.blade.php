@extends('layout')
@section('sendZakaat')

@if(session('success'))
<div class="bg-green-100 text-green-800 border border-green-300 rounded-lg px-4 py-2 text-sm">
    {{ session('success') }}
    @if(session('zakat_id'))
        <div class="mt-2">
            <a href="{{ route('download.receipt', session('zakat_id')) }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                <i class="fas fa-download mr-1"></i> Télécharger le reçu
            </a>
        </div>
    @endif
</div>
@endif

@if ($errors->any())
<div class="bg-red-100 text-red-800 border border-red-300 rounded-lg px-4 py-2 text-sm">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Send Zakaat Section -->
<section id="sendZakaat" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-900">{{ __('messages.send_zakaat_title') }}</h2>
            <div class="decorative-divider"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">{{ __('messages.send_zakaat_subtitle') }}</p>
        </div>

        <form action="{{ route('processZakaat') }}" method="POST" id="zakatForm">
            @csrf

            <!-- Payment Method Selection -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-credit-card text-blue-800 mr-2"></i>
                    {{ __('messages.payment_method') }}
                </label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="card" class="mr-2" checked>
                        <span>{{ __('messages.card_payment') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="virement" class="mr-2">
                        <span>{{ __('messages.bank_transfer') }}</span>
                    </label>
                </div>
            </div>

            <!-- Montant de Zakaat -->
            <div class="mb-6">
                <label for="montant" class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-coins text-blue-800 mr-2"></i>
                    {{ __('messages.zakaat_amount_label') }}
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                    <input
                        type="number"
                        id="montant"
                        name="montant"
                        step="0.01"
                        min="1"
                        value="{{ old('montant', request('montant')) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-3 pl-8 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('montant') border-red-500 @enderror"
                        placeholder="0.00"
                        required>
                </div>
                @error('montant')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Association Name -->
            <div class="mb-6">
                <label for="association_name" class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-heart text-blue-800 mr-2"></i>
                    {{ __('messages.association_name') }}
                </label>
                <input
                    type="text"
                    id="association_name"
                    name="association_name"
                    value="{{ old('association_name') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('association_name') border-red-500 @enderror"
                    placeholder="{{ __('messages.enter_association_name') }}"
                    required>
                @error('association_name')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-envelope text-blue-800 mr-2"></i>
                    {{ __('messages.email') }}
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', auth()->user()->email ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                    placeholder="votre@email.com"
                    required>
                @error('email')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Purpose (Optional) -->
            <div class="mb-6">
                <label for="purpose" class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-comment text-blue-800 mr-2"></i>
                    {{ __('messages.purpose_optional') }}
                </label>
                <textarea
                    id="purpose"
                    name="purpose"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('purpose') border-red-500 @enderror"
                    placeholder="{{ __('messages.purpose_placeholder') }}">{{ old('purpose') }}</textarea>
                @error('purpose')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Card Payment Section -->
            <div id="card-payment-section" class="mb-6">
                <label for="card-element" class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-credit-card text-blue-800 mr-2"></i>
                    {{ __('messages.card_details') }}
                </label>
                <div id="card-element" class="border border-gray-300 rounded-lg p-3"></div>
                <div id="card-errors" class="text-red-500 text-xs mt-1" role="alert"></div>
            </div>

            <!-- Bank Transfer Section -->
            <div id="virement-section" class="mb-6 hidden">
                <h4 class="text-lg font-semibold text-blue-900 mb-4">{{ __('messages.bank_details') }}</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="account_holder" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('messages.account_holder') }}
                        </label>
                        <input
                            type="text"
                            id="account_holder"
                            name="bank_details[account_holder]"
                            value="{{ old('bank_details.account_holder') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="{{ __('messages.account_holder_placeholder') }}">
                    </div>
                    
                    <div>
                        <label for="iban" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('messages.iban') }}
                        </label>
                        <input
                            type="text"
                            id="iban"
                            name="bank_details[iban]"
                            value="{{ old('bank_details.iban') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="FR76 1234 5678 9012 3456 7890 123">
                    </div>
                    
                    <div>
                        <label for="bic" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('messages.bic') }}
                        </label>
                        <input
                            type="text"
                            id="bic"
                            name="bank_details[bic]"
                            value="{{ old('bank_details.bic') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="BNPAFRPP">
                    </div>
                </div>

                <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-yellow-600"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">{{ __('messages.virement_info_title') }}</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>{{ __('messages.virement_info_text') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Récapitulatif -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h4 class="font-semibold text-blue-900 mb-2">{{ __('messages.donation_summary') }}</h4>
                <div class="flex justify-between items-center">
                    <span class="text-gray-700">{{ __('messages.zakaat_amount_label') }} :</span>
                    <span id="recap-montant" class="font-bold text-blue-800">0,00 €</span>
                </div>
                <div class="flex justify-between items-center mt-1">
                    <span class="text-gray-700">{{ __('messages.association') }} :</span>
                    <span id="recap-association" class="font-medium text-blue-800">Non saisie</span>
                </div>
                <div class="flex justify-between items-center mt-1">
                    <span class="text-gray-700">{{ __('messages.payment_method') }} :</span>
                    <span id="recap-payment-method" class="font-medium text-blue-800">Carte bancaire</span>
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('zakaat') }}"
                    class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 text-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ __('messages.back_to_calculation') }}
                </a>

                <button
                    type="submit"
                    class="flex-1 btn-primary font-bold py-3 px-6 rounded-lg transition duration-300 bg-blue-800 hover:bg-blue-900 text-white"
                    id="submitBtn">
                    <i class="fas fa-paper-plane mr-2"></i>
                    {{ __('messages.send_zakaat_btn') }}
                </button>
            </div>
            <input type="hidden" name="stripeToken" id="stripeToken" />
        </form>

        <!-- Information sur la sécurité -->
        <div class="mt-8 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-shield-alt text-green-600"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">{{ __('messages.secure_transaction') }}</h3>
                    <div class="mt-2 text-sm text-green-700">
                        <p>{{ __('messages.secure_transaction_info') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Stripe Elements (only for card payments)
    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a'
            }
        }
    });
    
    // Mount card element
    cardElement.mount('#card-element');
    
    // Form elements
    const form = document.getElementById('zakatForm');
    const montantInput = document.getElementById('montant');
    const associationInput = document.getElementById('association_name');
    const paymentMethodInputs = document.querySelectorAll('input[name="payment_method"]');
    const cardSection = document.getElementById('card-payment-section');
    const virementSection = document.getElementById('virement-section');
    
    // Recap elements
    const recapMontant = document.getElementById('recap-montant');
    const recapAssociation = document.getElementById('recap-association');
    const recapPaymentMethod = document.getElementById('recap-payment-method');
    const submitBtn = document.getElementById('submitBtn');
    const cardErrors = document.getElementById('card-errors');

    // Toggle payment sections
    function togglePaymentSections() {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
        
        if (selectedMethod === 'card') {
            cardSection.classList.remove('hidden');
            virementSection.classList.add('hidden');
            
            // Make card fields required
            document.getElementById('stripeToken').required = true;
            
            // Make bank fields not required
            document.getElementById('account_holder').required = false;
            document.getElementById('iban').required = false;
            document.getElementById('bic').required = false;
        } else {
            cardSection.classList.add('hidden');
            virementSection.classList.remove('hidden');
            
            // Make bank fields required
            document.getElementById('account_holder').required = true;
            document.getElementById('iban').required = true;
            document.getElementById('bic').required = true;
            
            // Make card fields not required
            document.getElementById('stripeToken').required = false;
        }
        
        updateRecap();
    }

    // Format amount
    function formatMontant(value) {
        return parseFloat(value || 0).toLocaleString('fr-FR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }) + ' €';
    }

    // Validate bank details
    function validateBankDetails() {
        const accountHolder = document.getElementById('account_holder').value.trim();
        const iban = document.getElementById('iban').value.trim();
        const bic = document.getElementById('bic').value.trim();
        
        if (!accountHolder || !iban || !bic) {
            return false;
        }
        
        return true;
    }

    // Update summary
    function updateRecap() {
        const montant = montantInput.value;
        const association = associationInput.value;
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        recapMontant.textContent = formatMontant(montant);
        recapAssociation.textContent = association || 'Non saisie';
        recapPaymentMethod.textContent = paymentMethod === 'card' ? 'Carte bancaire' : 'Virement bancaire';

        // Validate form
        let isValid = montant && parseFloat(montant) > 0 && association;
        
        if (paymentMethod === 'virement') {
            isValid = isValid && validateBankDetails();
        }

        submitBtn.disabled = !isValid;
        submitBtn.classList.toggle('opacity-50', !isValid);
        submitBtn.classList.toggle('cursor-not-allowed', !isValid);
    }

    // Event listeners
    montantInput.addEventListener('input', updateRecap);
    associationInput.addEventListener('input', updateRecap);
    paymentMethodInputs.forEach(input => {
        input.addEventListener('change', togglePaymentSections);
    });
    
    // Bank details inputs
    document.getElementById('account_holder').addEventListener('input', updateRecap);
    document.getElementById('iban').addEventListener('input', updateRecap);
    document.getElementById('bic').addEventListener('input', updateRecap);

    // Initialize
    togglePaymentSections();
    updateRecap();

    // Handle form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const montant = parseFloat(montantInput.value);
        const association = associationInput.value;
        
        // Basic validation
        if (!montant || montant <= 0) {
            alert('Veuillez saisir un montant valide.');
            return false;
        }

        if (!association) {
            alert('Veuillez saisir le nom de l\'association.');
            return false;
        }

        // Additional validation for bank transfer
        if (paymentMethod === 'virement' && !validateBankDetails()) {
            alert('Veuillez remplir tous les détails bancaires.');
            return false;
        }

        // Confirm before proceeding
        const paymentMethodText = paymentMethod === 'card' ? 'par carte bancaire' : 'par virement bancaire';
        const confirmation = confirm(`Êtes-vous sûr de vouloir envoyer ${formatMontant(montant)} à ${association} ${paymentMethodText} ?`);
        if (!confirmation) {
            return false;
        }

        // Disable button and show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Traitement en cours...';

        if (paymentMethod === 'card') {
            // Create Stripe token for card payments
            const { token, error } = await stripe.createToken(cardElement);
            
            if (error) {
                cardErrors.textContent = error.message;
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> {{ __("messages.send_zakaat_btn") }}';
                return false;
            } else {
                document.getElementById('stripeToken').value = token.id;
                form.submit();
            }
        } else {
            // For bank transfer, submit normally
            form.submit();
        }
    });

    // Real-time card validation
    cardElement.addEventListener('change', function(event) {
        if (event.error) {
            cardErrors.textContent = event.error.message;
        } else {
            cardErrors.textContent = '';
        }
    });
});
</script>

@endsection