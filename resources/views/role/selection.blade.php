<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un rôle - Chafaf</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1E3A8A;
            --secondary-color: #3B82F6;
            --accent-color: #10B981;
            --accent-light: #D1FAE5;
            --background-light: #F8FAFC;
            --text-color: #1E293B;
            --gold: #F59E0B;
            
            /* Couleurs des rôles */
            --imam-color: #6366f1; /* Indigo - comme Fajr */
            --chef-color: #ef4444; /* Rouge - comme Maghrib */
            --president-color: #8b5cf6; /* Violet - comme Isha */
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: var(--background-light);
        }

        .header-section {
            background-color: var(--primary-color);
            color: white;
            background-image: url('https://images.unsplash.com/photo-1564769625688-8654b7f90667?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
            position: relative;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(30, 58, 138, 0.85);
            z-index: 1;
        }

        .header-section>div {
            position: relative;
            z-index: 2;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.25);
        }

        .btn-primary:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(59, 130, 246, 0.3);
        }

        .section-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .role-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 2px solid transparent;
            position: relative;
            z-index: 1;
        }

        .role-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        /* Styles spécifiques aux rôles */
        .role-card.imam:hover {
            border-color: var(--imam-color);
            background-color: rgba(99, 102, 241, 0.05);
        }

        .role-card.chef:hover {
            border-color: var(--chef-color);
            background-color: rgba(239, 68, 68, 0.05);
        }

        .role-card.president:hover {
            border-color: var(--president-color);
            background-color: rgba(139, 92, 246, 0.05);
        }

        /* Icônes de rôle */
        .role-icon-container {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            position: relative;
        }

        .role-icon {
            font-size: 2.5rem;
            z-index: 2;
        }

        /* Animations des icônes */
        .role-icon-container.imam {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--imam-color);
        }

        .role-icon-container.imam::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: rgba(99, 102, 241, 0.05);
            animation: pulse 2s infinite;
            z-index: 1;
        }

        .role-icon-container.chef {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--chef-color);
        }

        .role-icon-container.chef::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid var(--chef-color);
            opacity: 0.5;
            animation: spin 10s linear infinite;
        }

        .role-icon-container.president {
            background-color: rgba(139, 92, 246, 0.1);
            color: var(--president-color);
        }

        .role-icon-container.president::before {
            content: '';
            position: absolute;
            width: 110%;
            height: 110%;
            border-radius: 50%;
            background: radial-gradient(circle, var(--president-color) 0%, transparent 70%);
            opacity: 0.15;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.3;
            }
            100% {
                transform: scale(1);
                opacity: 0.7;
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-5px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        .role-icon-container:hover .role-icon {
            transform: scale(1.1) rotate(5deg);
            transition: all 0.3s ease;
            text-shadow: 0 0 10px currentColor;
        }

        /* Points décoratifs en arrière-plan */
        .decorative-dots {
            position: absolute;
            width: 200px;
            height: 200px;
            background-image: radial-gradient(var(--gold) 1px, transparent 1px);
            background-size: 15px 15px;
            opacity: 0.1;
            border-radius: 50%;
            z-index: 0;
        }

        .dots-1 {
            top: 10%;
            left: 5%;
            transform: rotate(15deg);
        }

        .dots-2 {
            bottom: 10%;
            right: 5%;
            transform: rotate(-15deg);
        }

        /* Animation de chargement */
        .loading-text {
            animation: loading-pulse 1.5s infinite;
        }

        @keyframes loading-pulse {
            0% {
                opacity: 0.5;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0.5;
            }
        }

        .loading-dots::after {
            content: '...';
            animation: loading-dots 1.5s infinite;
            display: inline-block;
            width: 20px;
        }

        @keyframes loading-dots {
            0% {
                content: '.';
            }
            33% {
                content: '..';
            }
            66% {
                content: '...';
            }
            100% {
                content: '.';
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo à gauche -->
                <div class="flex items-center -ml-3">
                    <a href="/" class="text-2xl font-bold text-gray-800 flex items-center">
                        <img src="https://i.ibb.co/Jt8MZY5/islamic-logo.png" alt="Chafaf Logo" class="h-10 mr-3">
                        <span class="text-blue-800">Chafaf</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="header-section py-12">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ __('messages.role_selection') }} <span class="text-yellow-400">{{ __('messages.role') }}</span></h1>
                <div class="w-24 h-1 bg-yellow-400 mx-auto mb-6 rounded-full"></div>
                <p class="text-lg md:text-xl mb-8 opacity-90">
                    {{ __('messages.role_selection_subtitle') }}
                </p>
            </div>
        </div>
    </header>

    <!-- Role Selection Section -->
    <section class="py-16 bg-white relative">
        <div class="container mx-auto px-4">
            <div class="decorative-dots dots-1"></div>
            <div class="decorative-dots dots-2"></div>
            
            <form action="{{ route('role.set') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <!-- Imam Card -->
                    <div class="role-card imam bg-white p-8 text-center">
                        <div class="role-icon-container imam">
                            <i class="fas fa-pray role-icon"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ __('messages.imam') }}</h3>
                        <p class="text-gray-600 mb-6">{{ __('messages.imam_description') }}</p>
                        <label class="inline-flex items-center mt-4 cursor-pointer">
                            <input type="radio" name="role" value="imam" class="form-radio h-5 w-5 text-indigo-600" required>
                            <span class="ml-2 text-gray-700">{{ __('messages.select_this_role') }}</span>
                        </label>
                    </div>

                    <!-- Chef de Mosquée Card -->
                    <div class="role-card chef bg-white p-8 text-center">
                        <div class="role-icon-container chef">
                            <i class="fas fa-mosque role-icon"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ __('messages.mosque_leader') }}</h3>
                        <p class="text-gray-600 mb-6">{{ __('messages.mosque_leader_description') }}</p>
                        <label class="inline-flex items-center mt-4 cursor-pointer">
                            <input type="radio" name="role" value="chef" class="form-radio h-5 w-5 text-red-600" required>
                            <span class="ml-2 text-gray-700">{{ __('messages.select_this_role') }}</span>
                        </label>
                    </div>

                    <!-- Président Card -->
                    <div class="role-card president bg-white p-8 text-center">
                        <div class="role-icon-container president">
                            <i class="fas fa-user-tie role-icon"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ __('messages.president') }}</h3>
                        <p class="text-gray-600 mb-6">{{ __('messages.president_description') }}</p>
                        <label class="inline-flex items-center mt-4 cursor-pointer">
                            <input type="radio" name="role" value="president" class="form-radio h-5 w-5 text-purple-600" required>
                            <span class="ml-2 text-gray-700">{{ __('messages.select_this_role') }}</span>
                        </label>
                    </div>
                </div>
                
                <!-- Champs supplémentaires qui apparaissent après sélection d'un rôle -->
                <div id="additional-fields" class="max-w-2xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-md hidden transition-all duration-500 ease-in-out transform opacity-0 scale-95">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold mb-3">{{ __('messages.why_this_role') }}</h3>
                        <textarea name="motivation" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="{{ __('messages.motivation_placeholder') }}" required></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-xl font-bold mb-3">{{ __('messages.relevant_experience') }}</h3>
                        <textarea name="experience" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="{{ __('messages.experience_placeholder') }}" required></textarea>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <button type="submit" class="btn-primary px-8 py-3 rounded-full text-lg font-medium">
                        <i class="fas fa-check-circle mr-2"></i> {{ __('messages.confirm_choice') }}
                    </button>
                </div>
            </form>

            <div class="text-center mt-8">
                <a href="/" class="text-blue-800 hover:underline inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> {{ __('messages.back_to_home') }}
                </a>
            </div>
        </div>
    </section>

    <script>
        // Animation pour les boutons radio
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Réinitialiser tous les styles des cartes
                document.querySelectorAll('.role-card').forEach(card => {
                    card.style.borderColor = 'transparent';
                    card.style.transform = '';
                    card.style.boxShadow = '';
                });
                
                // Mettre en évidence la carte sélectionnée
                if (this.checked) {
                    const card = this.closest('.role-card');
                    let borderColor;
                    
                    if (card.classList.contains('imam')) {
                        borderColor = 'var(--imam-color)';
                    } else if (card.classList.contains('chef')) {
                        borderColor = 'var(--chef-color)';
                    } else {
                        borderColor = 'var(--president-color)';
                    }
                    
                    card.style.borderColor = borderColor;
                    card.style.transform = 'translateY(-10px)';
                    card.style.boxShadow = '0 12px 24px rgba(0, 0, 0, 0.15)';
                    
                    // Afficher les champs supplémentaires avec animation
                    const additionalFields = document.getElementById('additional-fields');
                    additionalFields.classList.remove('hidden');
                    
                    // Déclencher l'animation après que l'élément est visible
                    setTimeout(() => {
                        additionalFields.classList.remove('opacity-0', 'scale-95');
                        additionalFields.classList.add('opacity-100', 'scale-100');
                        
                        // Faire défiler jusqu'aux champs supplémentaires
                        additionalFields.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 50);
                }
            });
        });
    </script>
</body>

</html>
