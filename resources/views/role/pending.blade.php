<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande en attente - Chafaf</title>
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

        /* Cercles pulsants pour le statut */
        .pending-pulse {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: rgba(245, 158, 11, 0.1);
            margin: 0 auto 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pending-pulse::before,
        .pending-pulse::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: rgba(245, 158, 11, 0.15);
            z-index: 1;
        }

        .pending-pulse::before {
            animation: pulse-ring 2s infinite;
        }

        .pending-pulse::after {
            animation: pulse-ring 2s 0.5s infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 0.8;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.3;
            }
            100% {
                transform: scale(0.8);
                opacity: 0.8;
            }
        }

        .pending-icon {
            position: relative;
            z-index: 2;
            font-size: 3rem;
            color: var(--gold);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        /* Etoile scintillante */
        .star-container {
            position: absolute;
            top: -20px;
            right: -10px;
            z-index: 3;
        }

        .star {
            position: relative;
            color: var(--gold);
            font-size: 1.5rem;
            animation: twinkle 2s infinite;
        }

        @keyframes twinkle {
            0%, 100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
            50% {
                opacity: 0.7;
                transform: scale(0.8) rotate(15deg);
            }
        }

        /* Points tournants */
        .rotating-dots {
            position: absolute;
            width: 140%;
            height: 140%;
            top: -20%;
            left: -20%;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.5;
            z-index: 1;
        }

        .dot {
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: var(--gold);
            opacity: 0.3;
        }

        /* Timeline */
        .timeline {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            width: 2px;
            background-color: var(--accent-light);
            top: 0;
            bottom: 0;
            left: 15px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            left: -24px;
            background-color: white;
            border: 2px solid var(--accent-color);
            top: 4px;
            border-radius: 50%;
            z-index: 1;
        }

        .timeline-item.active::before {
            background-color: var(--accent-color);
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                transform: scale(1.2);
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .timeline-item.completed::before {
            background-color: var(--accent-color);
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
                <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ __('messages.pending_request') }} <span class="text-yellow-400">{{ __('messages.pending') }}</span></h1>
                <div class="w-24 h-1 bg-yellow-400 mx-auto mb-6 rounded-full"></div>
                <p class="text-lg md:text-xl mb-8 opacity-90">
                    {{ __('messages.pending_subtitle') }}
                </p>
            </div>
        </div>
    </header>

    <!-- Pending Section -->
    <section class="py-16 bg-white relative">
        <div class="container mx-auto px-4">
            <div class="decorative-dots dots-1"></div>
            <div class="decorative-dots dots-2"></div>
            
            <div class="max-w-3xl mx-auto">
                <!-- Status Icon -->
                <div class="pending-pulse">
                    <div class="star-container">
                        <i class="fas fa-star star"></i>
                    </div>
                    <div class="rotating-dots" id="rotatingDots"></div>
                    <i class="fas fa-hourglass-half pending-icon"></i>
                </div>
                
                <!-- Status Message -->
                <div class="text-center mb-12">
                    <h2 class="text-2xl font-bold mb-4">Votre demande pour devenir 
                        <span class="text-accent-role">
                            @if($role == 'imam')
                                <span class="text-indigo-500">Imam</span>
                            @elseif($role == 'chef')
                                <span class="text-red-500">Chef de Mosquée</span>
                            @elseif($role == 'president')
                                <span class="text-purple-500">Président</span>
                            @else
                                <span class="text-gray-500">{{ $role }}</span>
                            @endif
                        </span>
                        est en cours d'examen
                    </h2>
                    <p class="text-gray-600 mb-6">
                        Merci pour votre demande. Un administrateur du site examinera vos informations et validera votre rôle dans les plus brefs délais.
                    </p>
                </div>
                
                <!-- Timeline -->
                <div class="timeline mb-12">
                    <div class="timeline-item completed">
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <h3 class="font-bold text-gray-800">Soumission de la demande</h3>
                            <p class="text-gray-600">Votre demande a été soumise avec succès</p>
                            <div class="text-right text-sm text-gray-500 mt-2">{{ now()->format('d/m/Y à H:i') }}</div>
                        </div>
                    </div>
                    
                    <div class="timeline-item active">
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <h3 class="font-bold text-gray-800">Révision administrative</h3>
                            <p class="text-gray-600">Votre demande est en cours d'examen par nos administrateurs</p>
                            <div class="text-right text-sm text-gray-500 mt-2">En cours...</div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <h3 class="font-bold text-gray-800">Validation du rôle</h3>
                            <p class="text-gray-600">Après validation, vous recevrez un accès complet aux fonctionnalités liées à votre rôle</p>
                            <div class="text-right text-sm text-gray-500 mt-2">En attente</div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="text-center">
                    <a href="/" class="btn-primary px-8 py-3 rounded-full text-lg font-medium inline-block">
                        <i class="fas fa-home mr-2"></i> Retour à l'accueil
                    </a>
                    
                    <p class="text-gray-500 mt-4">
                        Vous recevrez une notification par email lorsque votre demande sera traitée
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Création des points tournants
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('rotatingDots');
            const numDots = 12;
            const radius = 60;
            
            // Créer les points
            for (let i = 0; i < numDots; i++) {
                const dot = document.createElement('div');
                dot.className = 'dot';
                
                // Positionner les points en cercle
                const angle = (i / numDots) * 2 * Math.PI;
                const x = radius * Math.cos(angle) + radius;
                const y = radius * Math.sin(angle) + radius;
                
                dot.style.left = `${x}px`;
                dot.style.top = `${y}px`;
                
                // Animation de rotation
                dot.style.animation = `rotate 15s linear infinite`;
                dot.style.animationDelay = `${i * 0.2}s`;
                
                container.appendChild(dot);
            }
            
            // Animation de rotation
            container.style.animation = 'spin 20s linear infinite';
        });
        
        // Animation pour rotation des points
        document.styleSheets[0].insertRule(`
            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
        `, document.styleSheets[0].cssRules.length);
    </script>
</body>

</html>
