<script>
    // Script for the language dropdown in the navbar
    document.addEventListener('DOMContentLoaded', function() {
        // Handle navbar language switcher
        const languageToggle = document.getElementById('language-toggle');
        const languageMenu = document.getElementById('language-menu');
        
        if (languageToggle && languageMenu) {
            languageToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                languageMenu.classList.toggle('active');
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!languageToggle.contains(event.target) && !languageMenu.contains(event.target)) {
                    languageMenu.classList.remove('active');
                }
            });
        }
        
        // Handle mobile menu
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
        
        // Handle floating language switcher
        const floatingToggle = document.getElementById('floating-language-toggle');
        const floatingMenu = document.getElementById('floating-language-menu');
        
        if (floatingToggle && floatingMenu) {
            const chevronIcon = floatingToggle.querySelector('.fa-chevron-up');
            
            floatingToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                floatingMenu.classList.toggle('show');
                if (chevronIcon) {
                    chevronIcon.style.transform = floatingMenu.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0)';
                }
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!floatingToggle.contains(event.target) && !floatingMenu.contains(event.target)) {
                    floatingMenu.classList.remove('show');
                    if (chevronIcon) {
                        chevronIcon.style.transform = 'rotate(0)';
                    }
                }
            });
        }
        
        // Adapter la direction du texte pour l'arabe
        if ('{{ app()->getLocale() }}' === 'ar') {
            document.body.style.direction = 'rtl';
            document.querySelectorAll('.text-left').forEach(el => {
                el.classList.remove('text-left');
                el.classList.add('text-right');
            });
            document.querySelectorAll('.text-right').forEach(el => {
                el.classList.remove('text-right');
                el.classList.add('text-left');
            });
        } else {
            document.body.style.direction = 'ltr';
            document.querySelectorAll('.text-right').forEach(el => {
                if (el.classList.contains('text-right-original')) {
                    el.classList.remove('text-left');
                    el.classList.add('text-right');
                }
            });
            document.querySelectorAll('.text-left').forEach(el => {
                if (el.classList.contains('text-left-original')) {
                    el.classList.remove('text-right');
                    el.classList.add('text-left');
                }
            });
        }
        
        // Marquer les alignements de texte originaux
        document.querySelectorAll('.text-left').forEach(el => {
            el.classList.add('text-left-original');
        });
        document.querySelectorAll('.text-right').forEach(el => {
            el.classList.add('text-right-original');
        });
        
        // Add animations for prayer times section
        // These are CSS animations defined in the styles.css 
        document.head.insertAdjacentHTML('beforeend', `
            <style>
                @keyframes float {
                    0% { transform: translateY(0px); }
                    50% { transform: translateY(-10px); }
                    100% { transform: translateY(0px); }
                }
                
                @keyframes twinkle {
                    0% { opacity: 1; }
                    50% { opacity: 0.5; }
                    100% { opacity: 1; }
                }
                
                @keyframes sunrise {
                    0% { transform: translateY(5px); opacity: 0.7; }
                    100% { transform: translateY(-5px); opacity: 1; }
                }
                
                @keyframes sunset {
                    0% { transform: translateY(-5px); opacity: 1; }
                    100% { transform: translateY(5px); opacity: 0.7; }
                }
                
                @keyframes spin-slow {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
                
                @keyframes pulse-slow {
                    0% { transform: scale(1); }
                    50% { transform: scale(1.05); }
                    100% { transform: scale(1); }
                }
                
                @keyframes ellipsis {
                    0% { content: '.'; }
                    33% { content: '..'; }
                    66% { content: '...'; }
                    100% { content: ''; }
                }
                
                .animate-float {
                    animation: float 3s ease-in-out infinite;
                }
                
                .animate-twinkle {
                    animation: twinkle 1.5s ease-in-out infinite;
                }
                
                .animate-sunrise {
                    animation: sunrise 2s ease-in-out infinite alternate;
                }
                
                .animate-sunset {
                    animation: sunset 2s ease-in-out infinite alternate;
                }
                
                .animate-spin-slow {
                    animation: spin-slow 10s linear infinite;
                }
                
                .animate-pulse-slow {
                    animation: pulse-slow 3s ease-in-out infinite;
                }
                
                .animate-ellipsis::after {
                    content: '';
                    animation: ellipsis 1.5s infinite steps(4);
                }
                
                .delay-300 {
                    animation-delay: 300ms;
                }
                
                .delay-700 {
                    animation-delay: 700ms;
                }
            </style>
        `);
    });

    // Handle notifications
    const notifications = document.querySelectorAll('.notification');
    
    notifications.forEach(notification => {
        // Add fade-in animation
        notification.classList.add('animate-fade-in');
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 5000);
    });

    // Handle language switching
    const languageButtons = document.querySelectorAll('.language-button');
    const languageMenu = document.querySelector('.language-menu');
    
    languageButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Toggle menu visibility
            if (languageMenu) {
                languageMenu.classList.toggle('active');
            }
            
            // Handle language selection
            const lang = this.getAttribute('data-lang');
            if (lang) {
                window.location.href = `/language/${lang}`;
            }
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (languageMenu && !e.target.closest('.language-button') && !e.target.closest('.language-menu')) {
            languageMenu.classList.remove('active');
        }
    });
});
</script>
