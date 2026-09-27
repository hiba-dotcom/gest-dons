    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration - Chafaf</title>
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
                --danger-color: #EF4444;
                --warning-color: #F59E0B;
                --success-color: #10B981;
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

            .btn-success {
                background-color: var(--success-color);
                color: white;
                transition: all 0.3s ease;
                box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25);
            }

            .btn-success:hover {
                background-color: #059669;
                transform: translateY(-2px);
            }

            .btn-danger {
                background-color: var(--danger-color);
                color: white;
                transition: all 0.3s ease;
                box-shadow: 0 4px 6px rgba(239, 68, 68, 0.25);
            }

            .btn-danger:hover {
                background-color: #DC2626;
                transform: translateY(-2px);
            }

            .sidebar {
                background-color: var(--primary-color);
                transition: all 0.3s ease;
            }

            .sidebar-item {
                transition: all 0.3s ease;
                border-left: 4px solid transparent;
            }

            .sidebar-item:hover,
            .sidebar-item.active {
                background-color: rgba(255, 255, 255, 0.1);
                border-left-color: var(--accent-color);
            }

            .card {
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
            }

            .card:hover {
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
                transform: translateY(-2px);
            }

            .stat-card {
                background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
                color: white;
            }

            .stat-card.success {
                background: linear-gradient(135deg, var(--success-color), #059669);
            }

            .stat-card.warning {
                background: linear-gradient(135deg, var(--warning-color), #D97706);
            }

            .stat-card.danger {
                background: linear-gradient(135deg, var(--danger-color), #DC2626);
            }

            .table-header {
                background-color: var(--background-light);
                border-bottom: 2px solid var(--accent-color);
            }

            .mobile-menu-overlay {
                background-color: rgba(0, 0, 0, 0.5);
            }

            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                }

                .sidebar.active {
                    transform: translateX(0);
                }
            }

            .fade-in {
                animation: fadeIn 0.5s ease-in;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .loading {
                display: inline-block;
                width: 20px;
                height: 20px;
                border: 3px solid rgba(255, 255, 255, .3);
                border-radius: 50%;
                border-top-color: #fff;
                animation: spin 1s ease-in-out infinite;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }
        </style>
    </head>

    <body>
        <!-- Mobile Menu Overlay -->
        <div id="mobile-overlay" class="fixed inset-0 mobile-menu-overlay z-40 hidden md:hidden"></div>

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar fixed left-0 top-0 h-full w-64 z-50 overflow-y-auto">
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center mb-8">
                    <img src="https://i.ibb.co/Jt8MZY5/islamic-logo.png" alt="Chafaf Logo" class="h-10 mr-3">
                    <div>
                        <h2 class="text-xl font-bold text-white">Chafaf</h2>
                        <p class="text-blue-200 text-sm">{{auth()->user()->firstname}} {{auth()->user()->lastname}}</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2">
                    <a href="{{route('admin.dashboard')}}" class="sidebar-item  flex items-center p-3 text-white rounded-lg {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <a href="{{route('association.postulation')}}" class="sidebar-item flex items-center p-3 text-white rounded-lg {{ request()->is('admin/postulations') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar mr-3"></i>
                        <span>Postulations</span>
                    </a>
                    <a href="{{route('users')}}" class="sidebar-item flex items-center p-3 text-white rounded-lg {{ request()->is('admin/users') ? 'active' : '' }}">
                        <i class="fas fa-users mr-3"></i>
                        <span>Utilisateurs</span>
                    </a>

                    <a href="{{route('admin.cours')}}" class="sidebar-item flex items-center p-3 text-white rounded-lg">
                        <i class="fas fa-book mr-3"></i>
                        <span>Cours</span>
                    </a>
                    <a href="#mosques" class="sidebar-item flex items-center p-3 text-white rounded-lg">
                        <i class="fas fa-mosque mr-3"></i>
                        <span>Mosquées</span>
                    </a>
                    <a href="#associations" class="sidebar-item flex items-center p-3 text-white rounded-lg">
                        <i class="fas fa-heart mr-3"></i>
                        <span>Associations</span>
                    </a>
                    <a href="#zakaat" class="sidebar-item flex items-center p-3 text-white rounded-lg">
                        <i class="fas fa-hand-holding-usd mr-3"></i>
                        <span>Zakaat</span>
                    </a>
                    <a href="#events" class="sidebar-item flex items-center p-3 text-white rounded-lg">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        <span>Événements</span>
                    </a>
                    <a href="{{route('admin.donations')}}" class="sidebar-item flex items-center p-3 text-white rounded-lg {{ request()->is('admin/donations*') ? 'active' : '' }}">
                        <i class="fas fa-donate mr-3"></i>
                        <span>Donations</span>
                    </a>
                    <a href="#settings" class="sidebar-item flex items-center p-3 text-white rounded-lg">
                        <i class="fas fa-cog mr-3"></i>
                        <span>Paramètres</span>
                    </a>
                </nav>
            </div>

            <!-- User Info -->
            <form method="POST" action="{{ route('logout') }}" class="absolute bottom-0 left-0 right-0 p-6 border-t border-blue-700">
                @csrf
                <button class="btn-danger px-4 py-2 rounded-lg text-sm font-medium flex items-center justify-center w-full">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    {{ __('messages.logout') }}
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="md:ml-64 min-h-screen">
            <!-- Top Bar -->
            

            <!-- Dashboard Content -->
            @yield('dashboard')
            @yield('postulations')
            @yield('users')
            @yield('donations')
            @yield('cours')
            @yield('coursDetails')
        </div>

        <!-- Loading Spinner (Hidden by default) -->
        <div id="loading" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded-lg text-center">
                <div class="loading mx-auto mb-4"></div>
                <p>Chargement en cours...</p>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mobile menu functionality
                const mobileMenuBtn = document.getElementById('mobile-menu-btn');
                const sidebar = document.getElementById('sidebar');
                const mobileOverlay = document.getElementById('mobile-overlay');

                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.add('active');
                    mobileOverlay.classList.remove('hidden');
                });

                mobileOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    mobileOverlay.classList.add('hidden');
                });

                // Sidebar navigation


                // Loading functions
                function showLoading() {
                    document.getElementById('loading').classList.remove('hidden');
                }

                function hideLoading() {
                    document.getElementById('loading').classList.add('hidden');
                }

                function updatePageTitle(title) {
                    document.querySelector('h1').textContent = title;
                }



                // Add fade-in animation to cards
                const cards = document.querySelectorAll('.card');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('fade-in');
                        }
                    });
                });

                cards.forEach(card => {
                    observer.observe(card);
                });

                // Search functionality (demo)
                const searchInput = document.querySelector('input[type="text"]');
                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        // Demo search - would normally filter table rows
                        console.log('Recherche:', this.value);
                    });
                }
            });
        </script>
    </body>

    </html>