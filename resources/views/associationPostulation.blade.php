@extends('layout')
@section('AssociationPostulation')
@if (session('success'))
    <div class="container mx-auto px-4 mt-6">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md" role="alert">
            <div class="flex items-center justify-between">
                <p class="font-semibold">{{ session('success') }}</p>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-700 hover:text-green-900 font-bold text-lg">&times;</button>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="container mx-auto px-4 mt-6">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md" role="alert">
            <div class="flex items-center justify-between">
                <p class="font-semibold">{{ session('error') }}</p>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900 font-bold text-lg">&times;</button>
            </div>
        </div>
    </div>
@endif


<!-- Hero Section avec animation -->
<!-- Hero Section compacte -->
<section class="header-section py-12 md:py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-900 to-blue-800 opacity-90"></div>
    <div class="absolute inset-0">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>
    <div class="container mx-auto px-4 text-center relative z-10">
        <div class="animate-fade-in-up">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                {{ __('messages.association_postulation_title') }}
            </h1>
            <p class="text-lg md:text-xl mb-8 opacity-90 max-w-3xl mx-auto leading-relaxed">
                {{ __('messages.association_postulation_subtitle') }}
            </p>
            <div class="flex flex-wrap justify-center gap-4 text-base">
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <i class="fas fa-users text-xl text-emerald-400"></i>
                    <span>{{ __('messages.leadership') }}</span>
                </div>
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <i class="fas fa-heart text-xl text-rose-400"></i>
                    <span>{{ __('messages.engagement') }}</span>
                </div>
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <i class="fas fa-star text-xl text-amber-400"></i>
                    <span>{{ __('messages.innovation') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire de Postulation avec design moderne -->
<section class="py-20 bg-gradient-to-br from-slate-50 to-blue-50 relative">
    
    <div class="container mx-auto px-4">
        
        <div class="max-w-5xl mx-auto">
            
            <!-- En-tête moderne -->
            <div class="text-center mb-16 animate-fade-in-up">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mb-6">
                    <i class="fas fa-clipboard-list text-3xl text-white"></i>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6">{{ __('messages.form_title') }}</h2>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto">
                    {{ __('messages.form_subtitle') }}
                </p>
            </div>

            <!-- Indicateur de progression -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">1</div>
                        <span class="text-sm font-medium text-gray-700">{{ __('messages.step_information') }}</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-4 rounded-full">
                        <div class="h-1 bg-blue-600 rounded-full progress-bar" style="width: 0%"></div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-bold text-sm">5</div>
                        <span class="text-sm font-medium text-gray-500">{{ __('messages.step_finalisation') }}</span>
                    </div>
                </div>
            </div>
            

            <!-- Formulaire avec cartes modernes -->
            <form action="{{ route('association.postulation.store') }}" method="POST" class="space-y-8" id="postulationForm">
                @csrf

                <!-- Section 1: Informations Personnelles -->
                <div class="form-card group" data-step="1">
                    <div class="card-header">
                        <div class="icon-wrapper bg-gradient-to-r from-blue-500 to-blue-600">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div>
                            <h3 class="card-title">{{ __('messages.personal_info_title') }}</h3>
                            <p class="card-subtitle">{{ __('messages.personal_info_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="input-group">
                                <label for="prenom" class="input-label">
                                    {{ __('messages.firstname_label') }} <span class="required">*</span>
                                </label>
                                <input type="text" id="prenom" name="firstname" required
                                    class="modern-input"
                                    placeholder="{{ __('messages.firstname_placeholder') }}">
                                <div class="input-focus-line"></div>
                            </div>

                            <div class="input-group">
                                <label for="nom" class="input-label">
                                    {{ __('messages.lastname_label') }} <span class="required">*</span>
                                </label>
                                <input type="text" id="nom" name="lastname" required
                                    class="modern-input"
                                    placeholder="{{ __('messages.lastname_placeholder') }}">
                                <div class="input-focus-line"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Expériences -->
                <div class="form-card group" data-step="2">
                    <div class="card-header">
                        <div class="icon-wrapper bg-gradient-to-r from-emerald-500 to-emerald-600">
                            <i class="fas fa-briefcase text-grey-500"></i>
                        </div>
                        <div>
                            <h3 class="card-title">{{ __('messages.experiences_title') }}</h3>
                            <p class="card-subtitle">{{ __('messages.experiences_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="input-group">
                            <label for="experiences" class="input-label">
                                {{ __('messages.experiences_label') }} <span class="required">*</span>
                            </label>
                            <textarea id="experiences" name="experiences" required rows="6"
                                class="modern-textarea"
                                placeholder="{{ __('messages.experiences_placeholder') }}"></textarea>
                            <div class="char-counter">
                                <span class="char-count">0</span>{{ __('messages.char_minimum_100') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Motivations -->
                <div class="form-card group" data-step="3">
                    <div class="card-header">
                        <div class="icon-wrapper bg-gradient-to-r from-rose-500 to-rose-600">
                            <i class="fas fa-heart text-grey-500"></i>
                        </div>
                        <div>
                            <h3 class="card-title">{{ __('messages.motivations_title') }}</h3>
                            <p class="card-subtitle">{{ __('messages.motivations_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="input-group">
                            <label for="motivations" class="input-label">
                                {{ __('messages.motivations_label') }} <span class="required">*</span>
                            </label>
                            <textarea id="motivations" name="motivations" required rows="6"
                                class="modern-textarea"
                                placeholder="{{ __('messages.motivations_placeholder') }}"></textarea>
                            <div class="char-counter">
                                <span class="char-count">0</span>{{ __('messages.char_minimum_100') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Plan de Travail -->
                <div class="form-card group" data-step="4">
                    <div class="card-header">
                        <div class="icon-wrapper bg-gradient-to-r from-purple-500 to-purple-600">
                            <i class="fas fa-clipboard-list text-white"></i>
                        </div>
                        <div>
                            <h3 class="card-title">{{ __('messages.plan_title') }}</h3>
                            <p class="card-subtitle">{{ __('messages.plan_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="input-group">
                            <label for="plan_travail" class="input-label">
                                {{ __('messages.plan_label') }} <span class="required">*</span>
                            </label>
                            <textarea id="plan_travail" name="plan" required rows="8"
                                class="modern-textarea"
                                placeholder="{{ __('messages.plan_placeholder') }}"></textarea>
                            <div class="char-counter">
                                <span class="char-count">0</span>{{ __('messages.char_minimum_200') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Informations de l'Association -->
                <div class="form-card featured group" data-step="5">
                    <div class="card-header">
                        <div class="icon-wrapper bg-gradient-to-r from-indigo-500 to-indigo-600">
                            <i class="fas fa-building text-white"></i>
                        </div>
                        <div>
                            <h3 class="card-title">{{ __('messages.association_info_title') }}</h3>
                            <p class="card-subtitle">{{ __('messages.association_info_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="space-y-6">
                            <!-- Nom et Slogan -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="input-group">
                                    <label for="nom_association" class="input-label">
                                        {{ __('messages.association_name_label') }} <span class="required">*</span>
                                    </label>
                                    <input type="text" id="nom_association" name="nom" required
                                        class="modern-input"
                                        placeholder="{{ __('messages.association_name_placeholder') }}">
                                    <div class="input-focus-line"></div>
                                </div>

                                <div class="input-group">
                                    <label for="slogan" class="input-label">
                                        {{ __('messages.association_slogan_label') }} <span class="required">*</span>
                                    </label>
                                    <input type="text" id="slogan" name="slogan" required
                                        class="modern-input"
                                        placeholder="{{ __('messages.association_slogan_placeholder') }}">
                                    <div class="input-focus-line"></div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="input-group">
                                <label for="description_association" class="input-label">
                                    {{ __('messages.association_description_label') }} <span class="required">*</span>
                                </label>
                                <textarea id="description_association" name="description" required rows="5"
                                    class="modern-textarea"
                                    placeholder="{{ __('messages.association_description_placeholder') }}"></textarea>
                            </div>

                            <!-- URL de l'image -->
                            <div class="input-group">
                                <label for="image_url" class="input-label">
                                    {{ __('messages.association_image_label') }}
                                </label>
                                <input type="url" id="image_url" name="image"
                                    class="modern-input"
                                    placeholder="{{ __('messages.association_image_placeholder') }}">
                                <div class="input-focus-line"></div>
                                <p class="input-help">{{ __('messages.association_image_help') }}</p>
                            </div>

                            <!-- Budget et Membres -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="input-group">
                                    <label for="budget" class="input-label">
                                        {{ __('messages.association_budget_label') }} <span class="required">*</span>
                                    </label>
                                    <input type="number" id="budget" name="totaleBudget" required min="0" step="0.01"
                                        class="modern-input"
                                        placeholder="{{ __('messages.association_budget_placeholder') }}">
                                    <div class="input-focus-line"></div>
                                    <p class="input-help">{{ __('messages.association_budget_help') }}</p>
                                </div>

                                <div class="input-group">
                                    <label for="total_membres" class="input-label">
                                        {{ __('messages.association_members_label') }} <span class="required">*</span>
                                    </label>
                                    <input type="number" id="total_membres" name="totaleMembres" required min="1"
                                        class="modern-input"
                                        placeholder="{{ __('messages.association_members_placeholder') }}">
                                    <div class="input-focus-line"></div>
                                    <p class="input-help">{{ __('messages.association_members_help') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conditions et soumission -->
                <div class="form-card final pt-5">
                    <div class="card-content">
                        <div class="checkbox-group mb-8">
                            <input type="checkbox" id="conditions" name="conditions" required class="modern-checkbox">
                            <label for="conditions" class="checkbox-label">
                                J'accepte les <a href="#" class="text-blue-600 hover:underline font-medium">conditions générales</a>
                                et je certifie que toutes les informations fournies sont exactes. Je comprends que cette
                                postulation sera examinée par l'équipe Chafaf.
                            </label>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex flex-col md:flex-row gap-4 justify-center">
                            <button type="submit" class="submit-btn group">
                                <span class="btn-content">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Soumettre ma Postulation
                                </span>
                                <div class="btn-loading hidden">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                    Envoi en cours...
                                </div>
                            </button>

                            <button type="reset" class="reset-btn">
                                <i class="fas fa-undo mr-2"></i>
                                Réinitialiser le Formulaire
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Section Informations Complémentaires avec design moderne -->
<section class="py-20 bg-gradient-to-r from-blue-900 via-purple-900 to-indigo-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl font-bold text-white mb-6">
                    Pourquoi Créer une Association avec Chafaf ?
                </h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Rejoignez un écosystème dynamique qui valorise l'innovation et l'impact communautaire
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="benefit-card">
                    <div class="benefit-icon bg-gradient-to-r from-blue-500 to-blue-600">
                        <i class="fas fa-hands-helping text-2xl text-white"></i>
                    </div>
                    <h3 class="benefit-title">Support Complet</h3>
                    <p class="benefit-text">
                        Accompagnement personnalisé dans toutes les démarches administratives et légales avec notre équipe d'experts
                    </p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon bg-gradient-to-r from-emerald-500 to-emerald-600">
                        <i class="fas fa-network-wired text-2xl text-white"></i>
                    </div>
                    <h3 class="benefit-title">Réseau Communautaire</h3>
                    <p class="benefit-text">
                        Intégration dans un réseau d'associations musulmanes actives et solidaires pour maximiser votre impact
                    </p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon bg-gradient-to-r from-purple-500 to-purple-600">
                        <i class="fas fa-chart-line text-2xl text-white"></i>
                    </div>
                    <h3 class="benefit-title">Visibilité Garantie</h3>
                    <p class="benefit-text">
                        Promotion premium de votre association sur la plateforme Chafaf et nos réseaux sociaux partenaires
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Variables CSS pour la cohérence */
    :root {
        --primary-color: #1E3A8A;
        --secondary-color: #3B82F6;
        --accent-color: #10B981;
        --accent-light: #D1FAE5;
        --background-light: #F8FAFC;
        --text-color: #1E293B;
        --gold: #F59E0B;
        --gradient-primary: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) rotate(5deg);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out;
    }

    /* Formes flottantes dans le hero */
    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .shape-1 {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 20%;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 70%;
        animation-delay: 4s;
    }

    /* Cartes de formulaire */
    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.4s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
    }

    .form-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .form-card.featured {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: 2px solid var(--secondary-color);
    }

    .form-card.final {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: white;
    }

    .card-header {
        display: flex;
        align-items: center;
        padding: 2rem 2rem 1rem;
        gap: 1rem;
    }

    .icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-color);
        margin: 0;
    }

    .card-subtitle {
        color: #64748b;
        margin: 0.25rem 0 0;
        font-size: 0.95rem;
    }

    .card-content {
        padding: 0 2rem 2rem;
    }

    /* Styles d'input modernes */
    .input-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .input-label {
        display: block;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .required {
        color: #ef4444;
        font-weight: bold;
    }

    .modern-input,
    .modern-textarea {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        position: relative;
    }

    .modern-input:focus,
    .modern-textarea:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }

    .modern-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .input-focus-line {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 2px;
        width: 0;
        background: var(--gradient-primary);
        transition: width 0.3s ease;
    }

    .modern-input:focus+.input-focus-line {
        width: 100%;
    }

    .input-help {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 0.5rem;
    }

    .char-counter {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 0.5rem;
        text-align: right;
    }

    .char-counter.valid {
        color: var(--accent-color);
    }

    .char-counter.invalid {
        color: #ef4444;
    }

    /* Checkbox moderne */
    .checkbox-group {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .modern-checkbox {
        width: 20px;
        height: 20px;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        appearance: none;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .modern-checkbox:checked {
        background: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .modern-checkbox:checked::after {
        content: '\2713';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 12px;
        font-weight: bold;
    }

    .checkbox-label {
        color: #e2e8f0;
        line-height: 1.6;
        cursor: pointer;
    }

    /* Boutons modernes */
    .submit-btn {
        background: var(--gradient-primary);
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        min-width: 250px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .reset-btn {
        background: transparent;
        color: #64748b;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        border: 2px solid #d1d5db;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .reset-btn:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
        color: var(--text-color);
    }

    /* Cartes de bénéfices */
    .benefit-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .benefit-card:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.15);
    }

    .benefit-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .benefit-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
    }

    .benefit-text {
        color: #e2e8f0;
        line-height: 1.6;
    }

    /* Barre de progression */
    .progress-bar {
        transition: width 0.5s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-card {
            margin: 0 1rem;
        }

        .card-header {
            padding: 1.5rem 1.5rem 1rem;
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .card-content {
            padding: 0 1.5rem 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
        }

        .floating-shapes {
            display: none;
        }
    }

    /* Animation au scroll */
    .form-card {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .form-card.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Animation des cartes au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.form-card').forEach(card => {
            observer.observe(card);
        });

        // 2. Gestion des compteurs de caractères
        const textareas = document.querySelectorAll('.modern-textarea');
        textareas.forEach(textarea => {
            const counter = textarea.nextElementSibling.querySelector('.char-count');
            const match = textarea.getAttribute('placeholder')?.match(/\d+/);
            const minLength = match ? parseInt(match[0]) : 0;

            // Mise à jour initiale
            updateCounter(textarea, counter, minLength);

            // Écouteur d'événements
            textarea.addEventListener('input', () => {
                updateCounter(textarea, counter, minLength);
                updateProgressBar();
            });
        });

        function updateCounter(textarea, counter, minLength) {
            const length = textarea.value.length;
            counter.textContent = length;

            if (length >= minLength) {
                counter.parentElement.classList.add('valid');
                counter.parentElement.classList.remove('invalid');
            } else {
                counter.parentElement.classList.add('invalid');
                counter.parentElement.classList.remove('valid');
            }
        }

        // 3. Barre de progression
        const progressBar = document.querySelector('.progress-bar');
        const formSteps = document.querySelectorAll('.form-card[data-step]');

        function updateProgressBar() {
            let completedSteps = 0;

            formSteps.forEach(step => {
                const inputs = step.querySelectorAll('input[required], textarea[required], select[required]');
                let isStepComplete = true;

                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isStepComplete = false;
                    }
                });

                if (isStepComplete) completedSteps++;
            });

            const progress = (completedSteps / formSteps.length) * 100;
            progressBar.style.width = `${progress}%`;

            // Mettre à jour les indicateurs numériques
            updateStepIndicators(completedSteps);
        }

        // 4. Mise à jour des indicateurs d'étape
        function updateStepIndicators(completedSteps) {
            const stepNumbers = document.querySelectorAll('.flex.items-center.space-x-2 .w-8.h-8');

            stepNumbers.forEach((step, index) => {
                if (index < completedSteps) {
                    step.classList.remove('bg-gray-300', 'text-gray-600');
                    step.classList.add('bg-blue-600', 'text-white');

                    // Mettre à jour le texte
                    const textElement = step.closest('.flex.items-center').querySelector('span');
                    if (textElement) {
                        textElement.classList.remove('text-gray-500');
                        textElement.classList.add('text-gray-700');
                    }
                } else if (index === completedSteps) {
                    // Étape actuelle (pulse animation)
                    step.classList.remove('bg-gray-300', 'text-gray-600');
                    step.classList.add('bg-blue-400', 'text-white', 'animate-pulse');
                } else {
                    // Étapes non complétées
                    step.classList.remove('bg-blue-600', 'bg-blue-400', 'text-white', 'animate-pulse');
                    step.classList.add('bg-gray-300', 'text-gray-600');

                    const textElement = step.closest('.flex.items-center').querySelector('span');
                    if (textElement) {
                        textElement.classList.add('text-gray-500');
                        textElement.classList.remove('text-gray-700');
                    }
                }
            });
        }

        // 5. Soumission du formulaire
        const form = document.getElementById('postulationForm');
        const submitBtn = form.querySelector('.submit-btn');
        const btnContent = form.querySelector('.btn-content');
        const btnLoading = form.querySelector('.btn-loading');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Validation finale
            if (!validateForm()) {
                alert('Veuillez remplir tous les champs obligatoires correctement.');
                return;
            }

            // État de chargement
            submitBtn.disabled = true;
            btnContent.classList.add('hidden');
            btnLoading.classList.remove('hidden');

            try {
                // Simulation d'envoi (remplacer par un vrai fetch dans la réalité)
                await simulateSubmission();

                // Succès
                showSuccessMessage();
                form.reset();
                updateProgressBar(); // Réinitialiser la progression
            } catch (error) {
                showErrorMessage(error);
            } finally {
                submitBtn.disabled = false;
                btnContent.classList.remove('hidden');
                btnLoading.classList.add('hidden');
            }
        });

        function validateForm() {
            let isValid = true;

            // Vérifier tous les champs requis
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;

                    // Scroll vers le premier champ invalide
                    if (isValid === false) {
                        field.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        field.focus();
                    }
                } else {
                    field.classList.remove('border-red-500');

                    // Validation spécifique pour les textarea
                    if (field.tagName === 'TEXTAREA') {
                        const match = textarea.getAttribute('placeholder')?.match(/\d+/);
                        const minLength = match ? parseInt(match[0]) : 0;
                        if (field.value.length < minLength) {
                            isValid = false;
                            field.classList.add('border-red-500');
                        }
                    }
                }
            });

            // Vérifier la checkbox des conditions
            const conditionsCheckbox = document.getElementById('conditions');
            if (!conditionsCheckbox.checked) {
                conditionsCheckbox.parentElement.classList.add('text-red-400');
                isValid = false;

                if (isValid === false) {
                    conditionsCheckbox.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            } else {
                conditionsCheckbox.parentElement.classList.remove('text-red-400');
            }

            return isValid;
        }

        function simulateSubmission() {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    // Simuler une erreur aléatoire (pour démo)
                    const shouldFail = Math.random() > 0.8; // 20% de chance d'échec

                    if (shouldFail) {
                        reject(new Error('Erreur de connexion au serveur'));
                    } else {
                        resolve();
                    }
                }, 1500);
            });
        }

        function showSuccessMessage() {
            // Créer une notification de succès
            const successDiv = document.createElement('div');
            successDiv.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-xl z-50 animate-fade-in-up';
            successDiv.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <div>
                    <p class="font-bold">Postulation envoyée!</p>
                    <p class="text-sm">Nous vous contacterons sous peu.</p>
                </div>
            </div>
        `;

            document.body.appendChild(successDiv);

            // Supprimer après 5 secondes
            setTimeout(() => {
                successDiv.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => successDiv.remove(), 300);
            }, 5000);
        }

        function showErrorMessage(error) {
            console.error('Erreur:', error);

            const errorDiv = document.createElement('div');
            errorDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-xl z-50 animate-fade-in-up';
            errorDiv.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-3 text-xl"></i>
                <div>
                    <p class="font-bold">Erreur d'envoi</p>
                    <p class="text-sm">${error.message || 'Veuillez réessayer plus tard.'}</p>
                </div>
            </div>
        `;

            document.body.appendChild(errorDiv);

            setTimeout(() => {
                errorDiv.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => errorDiv.remove(), 300);
            }, 5000);
        }

        // 6. Initialisation
        updateProgressBar(); // Mettre à jour l'état initial

        // Écouteurs pour mettre à jour la progression
        form.addEventListener('input', updateProgressBar);
        form.addEventListener('change', updateProgressBar);
    });
</script>

@endsection