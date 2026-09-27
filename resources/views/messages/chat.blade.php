@extends(auth()->user()->role === 'imam' ? 'imam/imamLayout' : './layout')
@section('messages')
<meta name="csrf-token" content="{{ csrf_token() }}">
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

    .message-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }

    /* Styles pour les bulles de conversation */
    .message-bubble {
        max-width: 70%;
        word-wrap: break-word;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .message-bubble.sent {
        margin-left: auto;
        margin-right: 0;
    }

    .message-bubble.received {
        margin-left: 0;
        margin-right: auto;
    }

    .message-content.sent {
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        color: white;
        border-radius: 18px 18px 4px 18px;
        padding: 12px 16px;
    }

    .message-content.received {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        color: #374151;
        border-radius: 18px 18px 18px 4px;
        border-left: 4px solid var(--secondary-color);
        padding: 12px 16px;
    }

    .message-bubble:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }

    .message-time {
        font-size: 0.75rem;
        opacity: 0.7;
        margin-top: 4px;
    }

    .message-time.sent {
        text-align: right;
        color: rgba(255, 255, 255, 0.8);
    }

    .message-time.received {
        text-align: left;
        color: #6b7280;
    }

    /* Styles améliorés pour le formulaire de message */
    .chat-form {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        position: sticky;
        bottom: 0;
    }

    .message-input-container {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        background: #f8fafc;
        border-radius: 25px;
        padding: 8px;
        border: 2px solid #e5e7eb;
    }

    .message-input-container:focus-within {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-textarea {
        border: none;
        background: transparent;
        resize: none;
        outline: none;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        line-height: 1.5;
        max-height: 120px;
        min-height: 20px;
        padding: 8px 12px;
        flex: 1;
    }

    .send-button {
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .send-button:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .send-button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    .status-read {
        color: var(--accent-color);
    }

    .status-unread {
        color: #64748b;
    }

    .chat-header {
        border-radius: 15px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
    }

    /* Nouveaux styles pour la sidebar */
    .chat-layout {
        display: flex;
        height: calc(100vh - 2rem);
        gap: 1rem;
    }

    .users-sidebar {
        width: 300px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .user-item {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-item:hover {
        background-color: #f8fafc;
        transform: translateX(5px);
    }

    .user-item.active {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    .user-item.active .user-avatar {
        background: rgba(255, 255, 255, 0.2);
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .user-status {
        font-size: 0.875rem;
        opacity: 0.7;
    }

    .unread-badge {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: bold;
        flex-shrink: 0;
    }

    .sidebar-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 1.5rem;
        text-align: center;
    }

    /* Styles pour la barre de recherche */
    .search-container {
        margin-top: 1rem;
    }

    .search-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-input {
        width: 100%;
        padding: 10px 40px 10px 40px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .search-input:focus {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 12px;
        color: rgba(255, 255, 255, 0.7);
        z-index: 2;
    }

    .clear-search {
        position: absolute;
        right: 12px;
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        padding: 4px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .clear-search:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    /* Styles pour les résultats de recherche */
    .user-item.hidden {
        display: none;
    }

    .no-results {
        padding: 2rem 1rem;
        text-align: center;
        color: #6b7280;
        display: none;
    }

    .no-results.show {
        display: block;
    }

    @media (max-width: 768px) {
        .chat-layout {
            flex-direction: column;
            height: auto;
        }
        
        .users-sidebar {
            width: 100%;
            height: 200px;
            order: 2;
        }
        
        .chat-main {
            order: 1;
        }

        .message-bubble {
            max-width: 85%;
        }
    }
</style>
</head>

<body class="min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-4">
        <div class="chat-layout">
            <!-- Sidebar des utilisateurs -->
            <div class="users-sidebar">
                <div class="sidebar-header">
                    <h3 class="text-lg font-bold flex items-center justify-center mb-4">
                        <i class="fas fa-users mr-2"></i>
                        Conversations
                    </h3>
                    <!-- Barre de recherche -->
                    <div class="search-container">
                        <div class="search-input-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input 
                                type="text" 
                                id="user-search" 
                                class="search-input" 
                                placeholder="Rechercher un utilisateur..."
                                autocomplete="off"
                            >
                            <button class="clear-search" id="clear-search" style="display: none;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="overflow-y-auto" style="height: calc(100% - 80px);">
                    <!-- Liste des utilisateurs dynamique -->
                    @if(isset($users) && count($users) > 0)
                        @foreach($users as $user)
                        <div class="user-item {{ isset($receiver) && $receiver->id == $user->id ? 'active' : '' }}" 
                             onclick="window.location.href='{{ route('messages.show', $user->id) }}'">
                            <div class="user-avatar">
                                {{ strtoupper(substr($user->firstname, 0, 1)) }}
                            </div>
                            <div class="user-info">
                                <div class="user-name">{{ $user->firstname }} {{ $user->lastname ?? '' }}</div>
                                <div class="user-status">
                                    {{ $user->role == 'imam' ? 'Imam' : 'Adhérent' }}
                                </div>
                            </div>
                            @if($user->unread_count > 0)
                                <div class="unread-badge">
                                    {{ $user->unread_count }}
                                </div>
                            @endif
                        </div>
                        @endforeach
                    @else
                        <div class="p-4 text-center text-gray-500">
                            <i class="fas fa-inbox text-2xl mb-2"></i>
                            <p>Aucune conversation disponible</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Zone de conversation principale -->
            <div class="chat-main">
                <!-- En-tête de conversation -->
                <div class="chat-header p-6 mb-6 rounded-t-15">
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                            <i class="fas fa-user text-2xl"></i>
                        </div>
                        <div>
                            <!-- Votre code original conservé -->
                            <h2 class="text-2xl font-bold mb-1">Conversation avec {{ $receiver->firstname ?? 'Utilisateur' }}</h2>
                            <p class="opacity-80">Discussion privée</p>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="message-container p-6 mb-6 flex-1">
                    <div class="space-y-4 max-h-96 overflow-y-auto" id="messages-container">
                        <!-- Votre code original modifié pour les bulles -->
                        @if(isset($messages))
                            @foreach($messages as $message)
                            <div class="message-bubble {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                <div class="message-content {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                    <div class="message-sender font-semibold mb-1" style="font-size: 0.875rem;">
                                        {{ $message->sender_id == auth()->id() ? 'Vous' : $message->sender->firstname }}
                                    </div>
                                    <div class="message-text">
                                        {{ $message->content }}
                                    </div>
                                </div>
                                <div class="message-time {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $message->created_at->diffForHumans() }}
                                </div>
                            </div>
                            @endforeach
                        @else
                            <!-- Messages d'exemple si $messages n'est pas défini -->
                            <div class="message-bubble received">
                                <div class="message-content received">
                                    <div class="message-sender font-semibold mb-1" style="font-size: 0.875rem;">
                                        Ahmed
                                    </div>
                                    <div class="message-text">
                                        Assalamu alaikum, j'espère que vous allez bien.
                                    </div>
                                </div>
                                <div class="message-time received">
                                    <i class="fas fa-clock mr-1"></i>
                                    Il y a 5 min
                                </div>
                            </div>
                            <div class="message-bubble sent">
                                <div class="message-content sent">
                                    <div class="message-sender font-semibold mb-1" style="font-size: 0.875rem;">
                                        Vous
                                    </div>
                                    <div class="message-text">
                                        Wa alaikum salam, alhamdulillah ça va bien, et vous ?
                                    </div>
                                </div>
                                <div class="message-time sent">
                                    <i class="fas fa-clock mr-1"></i>
                                    Il y a 2 min
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Formulaire d'envoi amélioré -->
                <div class="chat-form p-4">
                    <!-- Votre code original conservé avec nouveau style -->
                    <form action="{{ route('messages.store') }}" method="POST" id="message-form">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $receiver->id ?? '' }}">

                        <div class="message-input-container">
                            <textarea 
                                name="content" 
                                id="content" 
                                required 
                                rows="1" 
                                class="form-textarea" 
                                placeholder="Tapez votre message..."
                                onkeydown="handleKeyPress(event)"
                            ></textarea>
                            <button type="submit" class="send-button" id="send-btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour formater la date
    function formatDate(dateString) {
        try {
            // Essayer différents formats de date
            let date;
            if (dateString.includes('T')) {
                // Format ISO
                date = new Date(dateString);
            } else {
                // Format Laravel standard
                date = new Date(dateString.replace(' ', 'T'));
            }
            
            // Vérifier si la date est valide
            if (isNaN(date.getTime())) {
                return 'Maintenant';
            }
            
            const now = new Date();
            const diffInSeconds = Math.floor((now - date) / 1000);
            
            if (diffInSeconds < 60) {
                return 'À l\'instant';
            } else if (diffInSeconds < 3600) {
                const minutes = Math.floor(diffInSeconds / 60);
                return `Il y a ${minutes} min`;
            } else if (diffInSeconds < 86400) {
                const hours = Math.floor(diffInSeconds / 3600);
                return `Il y a ${hours}h`;
            } else {
                return date.toLocaleDateString('fr-FR', {
                    day: '2-digit',
                    month: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        } catch (error) {
            console.error('Erreur de formatage de date:', error);
            return 'Maintenant';
        }
    }

    const userId = {{ auth()->id() }};
    window.Echo.private(`chat.${userId}`)
        .listen('MessageSent', (e) => {
            // Sélectionner le bon container - celui qui contient les messages existants
            const messagesContainer = document.getElementById('messages-container');
            const div = document.createElement('div');
            
            // Déterminer si c'est un message envoyé ou reçu
            const isSent = e.sender_id === userId;
            div.classList.add('message-bubble', isSent ? 'sent' : 'received');

            // Créer le HTML avec la nouvelle structure de bulles
            div.innerHTML = `
                <div class="message-content ${isSent ? 'sent' : 'received'}">
                    <div class="message-sender font-semibold mb-1" style="font-size: 0.875rem;">
                        ${isSent ? 'Vous' : e.sender_name}
                    </div>
                    <div class="message-text">
                        ${e.content}
                    </div>
                </div>
                <div class="message-time ${isSent ? 'sent' : 'received'}">
                    <i class="fas fa-clock mr-1"></i>
                    ${formatDate(e.created_at)}
                </div>
            `;

            // Ajouter le message dans le bon container
            messagesContainer.appendChild(div);
            
            // Scroll vers le bas
            const scrollContainer = document.querySelector('.max-h-96.overflow-y-auto');
            scrollContainer.scrollTop = scrollContainer.scrollHeight;

            // Vider le formulaire si c'est notre message
            if (isSent) {
                document.getElementById('content').value = '';
                autoResize();
            }
        });
});

// Auto-resize du textarea
function autoResize() {
    const textarea = document.getElementById('content');
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}

// Gestion de l'envoi avec Entrée
function handleKeyPress(event) {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        document.getElementById('message-form').submit();
    }
}

// Auto-scroll vers le bas des messages
document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.querySelector('.message-container');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Auto-resize du textarea
    const textarea = document.getElementById('content');
    if (textarea) {
        textarea.addEventListener('input', autoResize);
    }

    // Fonctionnalité de recherche d'utilisateurs
    initUserSearch();
});

// Fonction de recherche d'utilisateurs
function initUserSearch() {
    const searchInput = document.getElementById('user-search');
    const clearButton = document.getElementById('clear-search');
    const userItems = document.querySelectorAll('.user-item');
    const noResults = document.getElementById('no-results');

    if (!searchInput) return;

    // Fonction de recherche
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        userItems.forEach(item => {
            const userName = item.querySelector('.user-name').textContent.toLowerCase();
            const userRole = item.querySelector('.user-status').textContent.toLowerCase();
            
            if (userName.includes(searchTerm) || userRole.includes(searchTerm)) {
                item.classList.remove('hidden');
                visibleCount++;
            } else {
                item.classList.add('hidden');
            }
        });

        // Afficher/masquer le bouton clear
        if (searchTerm.length > 0) {
            clearButton.style.display = 'block';
        } else {
            clearButton.style.display = 'none';
        }

        // Afficher/masquer le message "aucun résultat"
        if (visibleCount === 0 && searchTerm.length > 0) {
            noResults.classList.add('show');
        } else {
            noResults.classList.remove('show');
        }
    }

    // Événements
    searchInput.addEventListener('input', performSearch);
    searchInput.addEventListener('keyup', performSearch);

    // Bouton clear
    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        performSearch();
        searchInput.focus();
    });

    // Clear avec Escape
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            searchInput.value = '';
            performSearch();
        }
    });
}
</script>
@endsection

</body>
</html>
@endsection