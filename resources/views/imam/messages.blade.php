@extends('imam/imamLayout')
@section('messages')

<style>
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

    .user-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .user-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(59, 130, 246, 0.15);
    }

    .user-card:hover::before {
        transform: scaleY(1);
    }

    .role-badge {
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .role-admin {
        background-color: #fee2e2;
        color: #dc2626;
    }

    .role-imam {
        background-color: #ecfdf5;
        color: #059669;
    }

    .role-president {
        background-color: #fef3c7;
        color: #d97706;
    }

    .role-chef {
        background-color: #e0e7ff;
        color: #3730a3;
    }

    .role-user {
        background-color: #f1f5f9;
        color: #475569;
    }

    .header-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
    }

    .search-box {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .search-box:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }
</style>
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <div class="flex items-center space-x-3">
        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
            <i class="fas fa-message text-white"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Messages</h1>
            <p class="text-gray-600 text-sm">Répondre aux questions des adhérants</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class=" rounded-xl shadow-sm p-6 mb-6">
        <!-- Liste des utilisateurs -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="usersList">
            @foreach($users as $user)
            <a href="{{ route('messages.show', $user->id) }}" class="user-card p-6 block hover:no-underline" data-role="{{ $user->role }}" data-name="{{ strtolower($user->firstname . ' ' . $user->name) }}">
                <div class="flex items-start space-x-4">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-3 rounded-full flex-shrink-0">
                        <i class="fas fa-user text-white text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-800 text-lg mb-1 truncate">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </h3>
                        <div class="flex items-center justify-between">
                            <span class="role-badge px-3 py-1 role-{{ strtolower(str_replace(['é', 'è', ' '], ['e', 'e', ''], $user->role)) }}">
                                {{ $user->role }}
                            </span>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                        <div class="mt-3 flex items-center text-sm text-gray-500">
                            <i class="fas fa-graduation-cap text-green-500 mr-1"></i> Disponible

                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-message mr-2"></i>
                            @if($user->unread_count > 0)
                            +{{ $user->unread_count }} nouveau{{ $user->unread_count > 1 ? 'x' : '' }} message{{ $user->unread_count > 1 ? 's' : '' }}
                            @else
                            Aucun nouveau message
                            @endif
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const roleFilter = document.getElementById('roleFilter');
            const userCards = document.querySelectorAll('.user-card');
            const noResults = document.getElementById('noResults');

            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedRole = roleFilter.value.toLowerCase();
                let visibleCount = 0;

                userCards.forEach(card => {
                    const name = card.getAttribute('data-name');
                    const role = card.getAttribute('data-role').toLowerCase();

                    const matchesSearch = name.includes(searchTerm);
                    const matchesRole = selectedRole === '' || role === selectedRole;

                    if (matchesSearch && matchesRole) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Afficher/masquer le message "aucun résultat"
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }

            // Event listeners pour la recherche
            searchInput.addEventListener('input', filterUsers);
            roleFilter.addEventListener('change', filterUsers);

            // Animation au scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Animer les cartes au chargement
            userCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(card);
            });
        });
    </script>
    @endsection