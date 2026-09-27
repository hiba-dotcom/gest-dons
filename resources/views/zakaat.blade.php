@extends('./layout')
@section('zakaat')
<!-- Zakaat Section -->
<section id="zakaat" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-900">{{ __('messages.zakaat_title') }}</h2>
            <div class="decorative-divider"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">{{ __('messages.zakaat_subtitle') }}</p>
        </div>

        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-8">
            <p class="text-gray-700 mb-6">{{ __('messages.zakaat_intro') }}</p>

            <div class="mb-8">
                <h3 class="text-xl font-bold mb-4 text-blue-900">{{ __('messages.zakaat_calculate_title') }}</h3>
                <div class="bg-blue-50 p-6 rounded-lg">
                    <!-- Nouveau : Sélection du référentiel Nisab -->
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2 font-medium">{{ __('messages.zakaat_nisab_label') }}</label>
                        <div class="flex gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="nisab_type" value="or" checked class="form-radio text-blue-800">
                                <span class="ml-2">{{ __('messages.zakaat_nisab_gold') }}</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="nisab_type" value="argent" class="form-radio text-blue-800">
                                <span class="ml-2">{{ __('messages.zakaat_nisab_silver') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Actifs -->
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">{{ __('messages.zakaat_gold_label') }}</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                <input type="number" id="or_non_porte" class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-8" placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">{{ __('messages.zakaat_silver_label') }}</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                <input type="number" id="argent_non_porte" class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-8" placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">{{ __('messages.zakaat_bank_label') }}</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                <input type="number" id="comptes_bancaires" class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-8" placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">{{ __('messages.zakaat_debt_receive_label') }}</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                <input type="number" id="dettes_recouvrables" class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-8" placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">{{ __('messages.zakaat_commercial_label') }}</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                <input type="number" id="biens_commerciaux" class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-8" placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">{{ __('messages.zakaat_crypto_label') }}</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                <input type="number" id="investissements" class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-8" placeholder="0">
                            </div>
                        </div>

                        <!-- Passifs -->
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">{{ __('messages.zakaat_debt_pay_label') }}</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                <input type="number" id="dettes_payer" class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-8" placeholder="0">
                            </div>
                        </div>

                        <!-- Nouveau : Durée de possession -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 mb-2 font-medium">{{ __('messages.zakaat_hawl_label') }}</label>
                            <div class="flex gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="hawl" value="oui" checked class="form-radio text-blue-800">
                                    <span class="ml-2">{{ __('messages.yes') }}</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="hawl" value="non" class="form-radio text-blue-800">
                                    <span class="ml-2">{{ __('messages.no') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button onclick="calculerZakat()" class="btn-primary w-full py-3 rounded-lg text-center font-medium bg-blue-800 text-white hover:bg-blue-900">
                            <i class="fas fa-calculator mr-2"></i> {{ __('messages.zakaat_calculate_btn') }}
                        </button>
                    </div>

                    <div class="mt-6 border-t pt-6">
                        <div class="mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-semibold">{{ __('messages.zakaat_nisab_threshold') }}</span>
                                <span id="nisab_value" class="text-lg font-bold text-blue-800">0,00 €</span>
                            </div>
                            <p id="nisab_detail" class="text-sm text-gray-500 mt-1"></p>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-semibold">{{ __('messages.zakaat_total_assets') }}</span>
                                <span id="total_actifs" class="text-lg font-bold text-blue-800">0,00 €</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-semibold">{{ __('messages.zakaat_total_debts') }}</span>
                                <span id="total_dettes" class="text-lg font-bold text-blue-800">0,00 €</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-semibold">{{ __('messages.zakaat_taxable_amount') }}</span>
                                <span id="montant_imposable" class="text-lg font-bold text-blue-800">0,00 €</span>
                            </div>
                        </div>
                        <div class="pt-4 border-t">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-semibold">{{ __('messages.zakaat_due') }}</span>
                                <span id="zakat_result" class="text-xl font-bold text-blue-800">0,00 €</span>
                            </div>
                            <p id="message_non_imposable" class="text-red-600 mt-2 hidden">{{ __('messages.zakaat_not_due') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-4 text-blue-900">{{ __('messages.zakaat_recipients_title') }}</h3>
                <p class="text-gray-700 mb-4">{{ __('messages.zakaat_recipients_intro') }}</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-hand-holding-heart text-blue-800 mr-3"></i>
                        <span>{{ __('messages.zakaat_recipient_poor') }}</span>
                    </div>
                    <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-hand-holding-heart text-blue-800 mr-3"></i>
                        <span>{{ __('messages.zakaat_recipient_needy') }}</span>
                    </div>
                    <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-hand-holding-heart text-blue-800 mr-3"></i>
                        <span>{{ __('messages.zakaat_recipient_admin') }}</span>
                    </div>
                    <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-hand-holding-heart text-blue-800 mr-3"></i>
                        <span>{{ __('messages.zakaat_recipient_hearts') }}</span>
                    </div>
                    <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-hand-holding-heart text-blue-800 mr-3"></i>
                        <span>{{ __('messages.zakaat_recipient_captives') }}</span>
                    </div>
                    <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-hand-holding-heart text-blue-800 mr-3"></i>
                        <span>{{ __('messages.zakaat_recipient_debtors') }}</span>
                    </div>
                    <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-hand-holding-heart text-blue-800 mr-3"></i>
                        <span>{{ __('messages.zakaat_recipient_path') }}</span>
                    </div>
                    <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-hand-holding-heart text-blue-800 mr-3"></i>
                        <span>{{ __('messages.zakaat_recipient_traveler') }}</span>
                    </div>
                </div>
                <a href="{{ route('sendZakaat')}}" class="text-blue-800 font-medium hover:underline flex items-center">
                    {{ __('messages.zakaat_give_btn') }}
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>


    </div>
</section>
<script>
    // Valeurs de référence (à mettre à jour périodiquement ou via API)
    const nisabValues = {
        or: 85 * 60, // 85g d'or à 60€/g (exemple - à actualiser)
        argent: 595 * 0.7 // 595g d'argent à 0.7€/g (exemple - à actualiser)
    };

    function calculerZakat() {
        // Récupérer les valeurs
        const nisabType = document.querySelector('input[name="nisab_type" ]:checked').value;
        const hawl = document.querySelector('input[name="hawl" ]:checked').value;

        // Calculer le Nisab
        const nisab = nisabValues[nisabType];
        document.getElementById('nisab_value').textContent = nisab.toLocaleString('fr-FR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }) + ' €';
        document.getElementById('nisab_detail').textContent = nisabType === 'or' ? "(85 grammes d'or)" : "(595 grammes d'argent)";

        // Fonction helper pour parser les valeurs
        const parseValue = (id) =>
            parseFloat(document.getElementById(id).value.replace(',', '.')) || 0;

        // Calculer les actifs
        const actifs = [
            parseValue('or_non_porte'),
            parseValue('argent_non_porte'),
            parseValue('comptes_bancaires'),
            parseValue('dettes_recouvrables'),
            parseValue('biens_commerciaux'),
            parseValue('investissements')
        ].reduce((a, b) => a + b, 0);

        // Calculer les dettes
        const dettes = parseValue('dettes_payer');

        // Montant imposable
        const montantImposable = Math.max(0, actifs - dettes);

        // Formater les nombres pour l'affichage
        const format = (num) => num.toLocaleString('fr-FR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        // Afficher les résultats intermédiaires
        document.getElementById('total_actifs').textContent = format(actifs) + ' €';
        document.getElementById('total_dettes').textContent = format(dettes) + ' €';
        document.getElementById('montant_imposable').textContent = format(montantImposable) + ' €';

        // Calculer la Zakat
        const zakatDue = (hawl === 'oui' && montantImposable >= nisab) ? montantImposable * 0.025 : 0;
        document.getElementById('zakat_result').textContent = format(zakatDue) + ' €';

        // Gérer l'affichage du message et le style
        const messageNonImposable = document.getElementById('message_non_imposable');
        const resultDivs = document.querySelectorAll('#zakat_result, #montant_imposable, #total_actifs, #total_dettes');

        if (zakatDue === 0) {
            messageNonImposable.classList.remove('hidden');
            resultDivs.forEach(div => div.style.color = '#6b7280'); // Griser les résultats
        } else {
            messageNonImposable.classList.add('hidden');
            resultDivs.forEach(div => div.style.color = ''); // Remettre la couleur par défaut
        }
    }
</script>
@endsection