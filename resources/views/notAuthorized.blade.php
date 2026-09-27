<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non Autorisé - Chafaf</title>
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
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: var(--background-light);
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

        .error-container {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
            border: 2px solid rgba(59, 130, 246, 0.2);
        }

        .icon-bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translate3d(0,0,0);
            }
            40%, 43% {
                transform: translate3d(0,-15px,0);
            }
            70% {
                transform: translate3d(0,-7px,0);
            }
            90% {
                transform: translate3d(0,-2px,0);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <!-- Error Card -->
            <div class="error-container rounded-2xl p-8 text-center fade-in">
                <!-- Logo -->
                <div class="mb-6">
                    <img src="https://i.ibb.co/Jt8MZY5/islamic-logo.png" alt="Chafaf Logo" class="h-16 mx-auto mb-4">
                    <h1 class="text-2xl font-bold text-blue-800">Chafaf</h1>
                </div>

                <!-- Error Icon -->
                <div class="mb-6">
                    <i class="fas fa-shield-alt text-6xl text-red-500 icon-bounce"></i>
                </div>

                <!-- Error Message -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Non Autorisé</h2>
                    <p class="text-gray-600 leading-relaxed mb-2">
                        Désolé, vous n'avez pas l'autorisation d'accéder à cette page.
                    </p>
                    <p class="text-sm text-gray-500">
                        Veuillez contacter l'administrateur si vous pensez qu'il s'agit d'une erreur.
                    </p>
                </div>

                

                <!-- Additional Info -->
                <div class="mt-6 text-sm text-gray-500">
                    <p>Code d'erreur: 403 - Accès refusé</p>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Besoin d'aide ? Contactez-nous :</p>
                <div class="flex items-center justify-center space-x-4 mt-2">
                    <a href="mailto:contact@chafaf.fr" class="flex items-center space-x-1 hover:text-blue-600 transition-colors">
                        <i class="fas fa-envelope"></i>
                        <span>contact@chafaf.fr</span>
                    </a>
                    <span class="text-gray-300">|</span>
                    <a href="tel:+33123456789" class="flex items-center space-x-1 hover:text-blue-600 transition-colors">
                        <i class="fas fa-phone"></i>
                        <span>+33 1 23 45 67 89</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Background decoration -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-100 rounded-full opacity-20"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-green-100 rounded-full opacity-20"></div>
    </div>
</body>

</html>