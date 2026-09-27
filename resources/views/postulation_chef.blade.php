@extends('./layout')

@section('postulationschef')
<style>
    /* Header Section Styles avec background mosquées */
    .header-section {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #1e40af 100%);
        position: relative;
        overflow: hidden;
        padding: 3rem 0;
        color: white;
    }

    .header-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M60 15 L75 35 L70 45 L60 35 L50 45 L45 35 Z'/%3E%3Ccircle cx='60' cy='50' r='8'/%3E%3Crect x='56' y='58' width='8' height='25'/%3E%3Crect x='20' y='75' width='80' height='8' rx='4'/%3E%3Crect x='25' y='83' width='70' height='20' rx='8'/%3E%3C/g%3E%3C/svg%3E");
        background-size: 180px 180px;
        background-repeat: repeat;
        animation: float 25s infinite linear;
    }

    .header-section::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 10%;
        transform: translateY(-50%);
        width: 300px;
        height: 300px;
        background: url("data:image/svg+xml,%3Csvg viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M60 10 L80 30 L75 45 L60 30 L45 45 L40 30 Z'/%3E%3Ccircle cx='60' cy='40' r='12'/%3E%3Crect x='54' y='52' width='12' height='35'/%3E%3Crect x='15' y='80' width='90' height='12' rx='6'/%3E%3Crect x='20' y='92' width='80' height='25' rx='12'/%3E%3C/g%3E%3C/svg%3E") center/contain no-repeat;
        pointer-events: none;
    }

    @keyframes float {
        0% { transform: translateX(0px) translateY(0px); }
        25% { transform: translateX(-10px) translateY(-15px); }
        50% { transform: translateX(0px) translateY(-25px); }
        75% { transform: translateX(10px) translateY(-15px); }
        100% { transform: translateX(0px) translateY(0px); }
    }

    /* Section Background */
    .section-background {
        background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%);
        position: relative;
        min-height: 100vh;
        padding: 4rem 0;
    }

    .section-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
    }

    /* Form Card Styles */
    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.1);
        overflow: hidden;
        max-width: 800px;
        margin: 0 auto;
        position: relative;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #1e40af, #3b82f6);
        background-size: 200% 100%;
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .form-header {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(30, 64, 175, 0.05));
        padding: 2.5rem 2rem 1.5rem;
        text-align: center;
        border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        position: relative;
    }

    .form-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #1e40af);
        border-radius: 2px;
    }

    .form-title {
        color: var(--primary-color);
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(30, 58, 138, 0.1);
    }

    .mosque-name {
        color: #3b82f6;
        font-weight: 800;
        font-size: 2rem;
        display: block;
        margin-top: 0.5rem;
        text-shadow: 0 1px 3px rgba(59, 130, 246, 0.2);
    }

    .form-subtitle {
        color: #64748B;
        font-size: 1rem;
        margin-top: 1rem;
        line-height: 1.6;
    }

    .form-content {
        padding: 2.5rem;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 2rem;
    }

    .form-label {
        display: block;
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }

    .required-asterisk {
        color: #ef4444;
        margin-left: 0.25rem;
    }

    .form-textarea {
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        line-height: 1.6;
        transition: all 0.3s ease;
        resize: vertical;
        min-height: 120px;
        background: #fafbfc;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }

    .form-textarea.error {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .error-message::before {
        content: '⚠️';
        font-size: 0.75rem;
    }

    /* Alert Styles */
    .alert {
        padding: 1rem 1.25rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
    }

    .alert-error {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        color: #dc2626;
        border-left: 4px solid #ef4444;
    }

    .alert-error::before {
        content: '❌';
        font-size: 1.2rem;
    }

    /* Button Styles */
    .form-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.875rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
    }

    .btn-secondary {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        border: 2px solid rgba(59, 130, 246, 0.2);
    }

    .btn-secondary:hover {
        background: rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.3);
        transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section-background {
            padding: 2rem 0;
        }

        .form-card {
            margin: 0 1rem;
        }

        .form-header {
            padding: 2rem 1.5rem 1.5rem;
        }

        .form-content {
            padding: 2rem 1.5rem;
        }

        .form-title {
            font-size: 1.5rem;
        }

        .mosque-name {
            font-size: 1.7rem;
        }

        .form-actions {
            flex-direction: column;
            align-items: center;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* Icon Animations */
    .mosque-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #3b82f6;
        opacity: 0.8;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.8; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.05); }
    }
</style>

<!-- Header Section -->
<section class="header-section">
    <div class="container mx-auto px-4 text-center">
        <div class="mb-8">
            <i class="fas fa-user-tie text-6xl mb-4 text-white opacity-90"></i>
            <h1 class="text-5xl font-bold mb-4">Candidature Chef de Mosquée</h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">
                Rejoignez notre communauté en tant que responsable spirituel et contribuez activement à la gestion d'une mosquée.
            </p>
        </div>
    </div>
</section>

<!-- Form Section -->
<section class="section-background">
    <div class="container mx-auto px-4">
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-mosque mosque-icon"></i>
                <h2 class="form-title">
                    Postuler pour devenir Chef de Mosquée
                    <span class="mosque-name">{{ $mosquee->name }}</span>
                </h2>
                <p class="form-subtitle">
                    Exprimez vos motivations et partagez vos expériences pour rejoindre notre équipe de responsables spirituels.
                </p>
            </div>

            <div class="form-content">
                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('postulation_chef.store', $mosquee->id) }}" method="POST">
                    @csrf

                    {{-- Motivations --}}
                    <div class="form-group">
                        <label for="motivations" class="form-label">
                            <i class="fas fa-heart text-red-500 mr-2"></i>
                            Vos Motivations
                            <span class="required-asterisk">*</span>
                        </label>
                        <textarea 
                            name="motivations" 
                            id="motivations" 
                            required
                            rows="5"
                            placeholder="Expliquez pourquoi vous souhaitez devenir chef de cette mosquée et quelle est votre vision pour la communauté..."
                            class="form-textarea @error('motivations') error @enderror">{{ old('motivations') }}</textarea>
                        @error('motivations')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Expériences --}}
                    <div class="form-group">
                        <label for="experiences" class="form-label">
                            <i class="fas fa-star text-yellow-500 mr-2"></i>
                            Vos Expériences
                            <span class="required-asterisk">*</span>
                        </label>
                        <textarea 
                            name="experiences" 
                            id="experiences" 
                            required
                            rows="5"
                            placeholder="Décrivez vos expériences religieuses, communautaires, de leadership ou toute autre compétence pertinente..."
                            class="form-textarea @error('experiences') error @enderror">{{ old('experiences') }}</textarea>
                        @error('experiences')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Envoyer ma candidature
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection