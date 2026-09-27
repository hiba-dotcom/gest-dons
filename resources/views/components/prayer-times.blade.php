@extends('../layout')
@section('aladhan')


<div class="min-h-screen p-4 md:p-8 relative" style="background-color: var(--background-light);">
    <!-- Add audio element for Adhan sound -->
    <audio id="adhan-audio" preload="auto">
        <source src="{{ asset('sounds/adhan.mp3') }}" type="audio/mpeg">
    </audio>
    
    <div class="container mx-auto">
        <!-- Header Section -->
        <div class="header-section text-center py-8 mb-6 rounded-lg relative overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-20 bg-blue-800"></div>
            <div class="relative z-10 max-w-4xl mx-auto px-4">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ __('messages.prayer_times_header') }}</h1>
                <p class="text-white/90 text-lg mb-6">{{ __('messages.prayer_times_subheader') }}</p>
                
                <!-- Country and City Selector -->
                <div class="bg-white rounded-lg p-4 shadow-md inline-block">
                    <form id="city-selector-form" class="flex flex-wrap items-center justify-center gap-4">
                        <div>
                            <label for="country-selector" class="text-blue-800 mr-3 font-medium">{{ __('messages.select_country') }} : </label>
                            <select id="country-selector" class="bg-white text-blue-800 rounded-md px-4 py-2 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" style="max-height: 300px; overflow-y: auto;" onchange="updateCountry()">
                                <option value="">Sélectionnez un pays</option>
                                <!-- Afrique -->
                                <optgroup label="Afrique">
                                    <option value="dz">Algérie</option>
                                    <option value="bj">Bénin</option>
                                    <option value="bf">Burkina Faso</option>
                                    <option value="cm">Cameroun</option>
                                    <option value="ci">Côte d'Ivoire</option>
                                    <option value="eg">Égypte</option>
                                    <option value="et">Ethiopie</option>
                                    <option value="gh">Ghana</option>
                                    <option value="gn">Guinée</option>
                                    <option value="ke">Kenya</option>
                                    <option value="ly">Libye</option>
                                    <option value="mg">Madagascar</option>
                                    <option value="ml">Mali</option>
                                    <option value="ma">Maroc</option>
                                    <option value="mr">Mauritanie</option>
                                    <option value="mu">Maurice</option>
                                    <option value="mz">Mozambique</option>
                                    <option value="ne">Niger</option>
                                    <option value="ng">Nigéria</option>
                                    <option value="rw">Rwanda</option>
                                    <option value="sn">Sénégal</option>
                                    <option value="za">Afrique du Sud</option>
                                    <option value="sd">Soudan</option>
                                    <option value="tz">Tanzanie</option>
                                    <option value="td">Tchad</option>
                                    <option value="tn">Tunisie</option>
                                    <option value="ug">Ouganda</option>
                                </optgroup>
                                
                                <!-- Moyen-Orient -->
                                <optgroup label="Moyen-Orient">
                                    <option value="sa">Arabie Saoudite</option>
                                    <option value="ae">Émirats Arabes Unis</option>
                                    <option value="bh">Bahreïn</option>
                                    <option value="iq">Irak</option>
                                    <option value="ir">Iran</option>
                                    <option value="jo">Jordanie</option>
                                    <option value="kw">Koweït</option>
                                    <option value="lb">Liban</option>
                                    <option value="om">Oman</option>
                                    <option value="ps">Palestine</option>
                                    <option value="qa">Qatar</option>
                                    <option value="sy">Syrie</option>
                                    <option value="tr">Turquie</option>
                                    <option value="ye">Yémen</option>
                                </optgroup>
                                
                                <!-- Asie -->
                                <optgroup label="Asie">
                                    <option value="af">Afghanistan</option>
                                    <option value="bd">Bangladesh</option>
                                    <option value="kh">Cambodge</option>
                                    <option value="cn">Chine</option>
                                    <option value="kr">Corée du Sud</option>
                                    <option value="in">Inde</option>
                                    <option value="id">Indonésie</option>
                                    <option value="jp">Japon</option>
                                    <option value="kz">Kazakhstan</option>
                                    <option value="my">Malaisie</option>
                                    <option value="mv">Maldives</option>
                                    <option value="mn">Mongolie</option>
                                    <option value="np">Népal</option>
                                    <option value="uz">Ouzbékistan</option>
                                    <option value="pk">Pakistan</option>
                                    <option value="ph">Philippines</option>
                                    <option value="sg">Singapour</option>
                                    <option value="lk">Sri Lanka</option>
                                    <option value="tj">Tadjikistan</option>
                                    <option value="tw">Taïwan</option>
                                    <option value="th">Thaïlande</option>
                                    <option value="vn">Vietnam</option>
                                </optgroup>
                                
                                <!-- Europe -->
                                <optgroup label="Europe">
                                    <option value="de">Allemagne</option>
                                    <option value="at">Autriche</option>
                                    <option value="be">Belgique</option>
                                    <option value="bg">Bulgarie</option>
                                    <option value="dk">Danemark</option>
                                    <option value="es">Espagne</option>
                                    <option value="fi">Finlande</option>
                                    <option value="fr">France</option>
                                    <option value="gr">Grèce</option>
                                    <option value="hu">Hongrie</option>
                                    <option value="ie">Irlande</option>
                                    <option value="it">Italie</option>
                                    <option value="no">Norvège</option>
                                    <option value="nl">Pays-Bas</option>
                                    <option value="pl">Pologne</option>
                                    <option value="pt">Portugal</option>
                                    <option value="ro">Roumanie</option>
                                    <option value="uk">Royaume-Uni</option>
                                    <option value="ru">Russie</option>
                                    <option value="se">Suède</option>
                                    <option value="ch">Suisse</option>
                                    <option value="ua">Ukraine</option>
                                </optgroup>
                                
                                <!-- Amérique -->
                                <optgroup label="Amérique">
                                    <option value="ar">Argentine</option>
                                    <option value="bo">Bolivie</option>
                                    <option value="br">Brésil</option>
                                    <option value="ca">Canada</option>
                                    <option value="cl">Chili</option>
                                    <option value="co">Colombie</option>
                                    <option value="cr">Costa Rica</option>
                                    <option value="cu">Cuba</option>
                                    <option value="ec">Équateur</option>
                                    <option value="us">États-Unis</option>
                                    <option value="gt">Guatemala</option>
                                    <option value="ht">Haïti</option>
                                    <option value="mx">Mexique</option>
                                    <option value="pa">Panama</option>
                                    <option value="py">Paraguay</option>
                                    <option value="pe">Pérou</option>
                                    <option value="uy">Uruguay</option>
                                    <option value="ve">Venezuela</option>
                                </optgroup>
                                
                                <!-- Océanie -->
                                <optgroup label="Océanie">
                                    <option value="au">Australie</option>
                                    <option value="fj">Fidji</option>
                                    <option value="nz">Nouvelle-Zélande</option>
                                    <option value="pg">Papouasie-Nouvelle-Guinée</option>
                                </optgroup>
                            </select>
                        </div>
                        <div>
                            <label for="city-selector" class="text-blue-800 mr-3 font-medium">{{ __('messages.select_city') }} : </label>
                            <select id="city-selector" class="bg-white text-blue-800 rounded-md px-4 py-2 border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" style="max-height: 300px; overflow-y: auto;" onchange="updateCity()" disabled>
                                <option value="">Sélectionnez d'abord un pays</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Date Display -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-primary-color text-xl font-semibold mb-1">{{ __('messages.currentDate') }}</h2>
                    <div class="text-gray-600 text-lg font-medium loading-text" id="gregorian-date">Chargement<span class="loading-dots">...</span></div>
                </div>
                <div class="border-t md:border-t-0 md:border-l border-gray-200 pt-4 md:pt-0 md:pl-6 w-full md:w-auto">
                    <h2 class="text-primary-color text-xl font-semibold mb-1">{{ __('messages.hijriDate') }}</h2>
                    <div class="text-gray-600 text-lg font-medium font-arabic">
                        <span id="hijri-date"></span> 
                        <span id="hijri-month"></span> 
                        <span id="hijri-year"></span>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 md:ml-6 bg-blue-50 rounded-lg p-4 text-center">
                    <div class="text-sm text-blue-600 mb-1">{{ __('messages.actual_prayer') }}</div>
                    <div class="text-xl font-bold text-primary-color loading-text" id="current-prayer-name">Chargement<span class="loading-dots">...</span></div>
                </div>
            </div>
        </div>
        
        <!-- Error Message -->
        <div id="error-container" class="hidden bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span id="error-message" class="ml-3"></span>
                <button onclick="updatePrayerTimes()" class="ml-auto text-blue-600 hover:text-blue-800 underline">Réessayer</button>
            </div>
        </div>
        

        
        <!-- Prayer Times Header -->
        <div id="adhan-section" class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-blue-900 mb-4 md:mb-0">{{ __('messages.Adhantime') }}</h2>
            <div class="flex items-center">
                <a href="javascript:void(0)" onclick="configureNotifications()" class="notification-button flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-2 px-4 rounded-full hover:shadow-lg transition-all duration-300 ease-in-out">
                    <div class="bell-container">
                        <i class="fas fa-bell notification-bell"></i>
                    </div>
                    <span>{{ __('messages.notifications') }}</span>
                </a>
            </div>
        </div>
        
        <!-- Prayer Times Grid -->
        <div id="prayer-times-container">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="prayer-cards-grid">
                <!-- Prayer cards will be inserted here dynamically -->
            </div>
        </div>
    </div>
</div>

<script>
    // Prayer configuration with French translations
    const prayers = [
        { name: 'Isha', french: 'Isha', arabic: 'العشاء', icon: '<i class="fas fa-moon prayer-icon prayer-icon-isha"></i>' },
        { name: 'Maghrib', french: 'Maghrib', arabic: 'المغرب', icon: '<i class="fas fa-cloud-sun prayer-icon prayer-icon-maghrib"></i>' },
        { name: 'Asr', french: 'Asr', arabic: 'العصر', icon: '<i class="fas fa-sun prayer-icon prayer-icon-asr"></i>' },
        { name: 'Dhuhr', french: 'Dhuhr', arabic: 'الظهر', icon: '<i class="fas fa-sun prayer-icon prayer-icon-dhuhr"></i>' },
        { name: 'Sunrise', french: 'Lever du soleil', arabic: 'الشروق', icon: '<i class="fas fa-cloud-sun-rain prayer-icon prayer-icon-sunrise"></i>' },
        { name: 'Fajr', french: 'Fajr', arabic: 'الفجر', icon: '<i class="fas fa-star prayer-icon prayer-icon-fajr"></i>' }
    ];

    // Update prayer times function
    async function updatePrayerTimes() {
        // Show loading state
        document.getElementById('prayer-cards-grid').innerHTML = `
            <div class="col-span-3 text-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary-color mx-auto"></div>
                <p class="mt-4 text-gray-600 loading-text">Chargement des horaires de prière<span class="loading-dots">...</span></p>
            </div>`;
        
        // Animation des points de chargement
        let dots = 0;
        const loadingInterval = setInterval(() => {
            const loadingDots = document.querySelector('.loading-dots');
            if (loadingDots) {
                dots = (dots + 1) % 4;
                loadingDots.textContent = '.'.repeat(dots);
            } else {
                clearInterval(loadingInterval);
            }
        }, 500);

        // Hide error container
        document.getElementById('error-container').classList.add('hidden');

        try {
            // Get selected city coordinates
            const citySelect = document.getElementById('city-selector');
            const selectedOption = citySelect.options[citySelect.selectedIndex];
            const lat = selectedOption.getAttribute('data-lat');
            const lng = selectedOption.getAttribute('data-lng');
            
            // Get current date
            const now = new Date();
            const day = now.getDate();
            const month = now.getMonth() + 1;
            const year = now.getFullYear();
            
            // Fetch prayer times from API
            const response = await fetch(`https://api.aladhan.com/v1/timings/${day}-${month}-${year}?latitude=${lat}&longitude=${lng}&method=2`);
            
            if (!response.ok) {
                throw new Error('Problème de connexion au réseau');
            }
            
            const data = await response.json();
            
            if (data.code !== 200) {
                throw new Error(data.status || 'Erreur inconnue');
            }
            
            const timings = data.data.timings;
            const date = data.data.date;
            
            // French weekday mapping
            const weekdaysFR = {
                'Monday': 'Lundi',
                'Tuesday': 'Mardi',
                'Wednesday': 'Mercredi',
                'Thursday': 'Jeudi',
                'Friday': 'Vendredi',
                'Saturday': 'Samedi',
                'Sunday': 'Dimanche'
            };
            
            // French month mapping
            const monthsFR = {
                'January': 'Janvier',
                'February': 'Février',
                'March': 'Mars',
                'April': 'Avril',
                'May': 'Mai',
                'June': 'Juin',
                'July': 'Juillet',
                'August': 'Août',
                'September': 'Septembre',
                'October': 'Octobre',
                'November': 'Novembre',
                'December': 'Décembre'
            };
            
            // Update date information in French
            const weekdayFR = weekdaysFR[date.gregorian.weekday.en] || date.gregorian.weekday.en;
            const monthFR = monthsFR[date.gregorian.month.en] || date.gregorian.month.en;
            
            document.getElementById('gregorian-date').textContent = 
                `${weekdayFR}, ${date.gregorian.day} ${monthFR} ${date.gregorian.year}`;
            
            document.getElementById('hijri-date').textContent = date.hijri.day;
            document.getElementById('hijri-month').textContent = date.hijri.month.en;
            document.getElementById('hijri-year').textContent = date.hijri.year;
            
            // Generate prayer cards
            const cardsHTML = prayers.map(prayer => {
                const time = timings[prayer.name];
                return `
                <div class="prayer-card card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300" 
                     data-prayer="${prayer.name}" data-time="${time}">
                    <div class="p-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="text-primary-color text-xl font-bold">${prayer.french}</h3>
                            <div class="text-2xl">${prayer.icon}</div>
                        </div>
                        <div class="text-gray-500 mt-1 font-arabic">${prayer.arabic}</div>
                    </div>
                    <div class="p-4 bg-gray-50">
                        <div class="flex justify-between items-center">
                            <div class="text-gray-500">Heure</div>
                            <div class="text-2xl font-bold text-primary-color">${time}</div>
                        </div>
                        <div class="prayer-status text-accent-color text-sm mt-1 font-medium text-right"></div>
                    </div>
                </div>`;
            }).join('');
            
            document.getElementById('prayer-cards-grid').innerHTML = cardsHTML;
            
            // Update current prayer and next prayer
            updateCurrentPrayer(timings);
            
        } catch (error) {
            // Show error message
            document.getElementById('error-container').classList.remove('hidden');
            document.getElementById('error-message').textContent = `Erreur: ${error.message}`;
            
            // Empty grid with error message
            document.getElementById('prayer-cards-grid').innerHTML = `
                <div class="col-span-3 text-center py-12 bg-white rounded-lg shadow-md">
                    <svg class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-gray-600">Impossible de charger les horaires de prière.</div>
                </div>`;
        }
    }
    
    // City data organized by country
    const citiesByCountry = {
        sa: [ // Saudi Arabia
            { id: 'makkah', name: 'La Mecque', lat: 21.4225, lng: 39.8262 },
            { id: 'madinah', name: 'Médine', lat: 24.5247, lng: 39.5692 },
            { id: 'riyadh', name: 'Riyad', lat: 24.7136, lng: 46.6753 },
            { id: 'jeddah', name: 'Djeddah', lat: 21.5433, lng: 39.1728 }
        ],
        eg: [ // Egypt
            { id: 'cairo', name: 'Le Caire', lat: 30.0444, lng: 31.2357 },
            { id: 'alexandria', name: 'Alexandrie', lat: 31.2001, lng: 29.9187 },
            { id: 'giza', name: 'Gizeh', lat: 30.0131, lng: 31.2089 }
        ],
        ma: [ // Morocco
            { id: 'rabat', name: 'Rabat', lat: 33.9716, lng: -6.8498 },
            { id: 'casablanca', name: 'Casablanca', lat: 33.5731, lng: -7.5898 },
            { id: 'fes', name: 'Fès', lat: 34.0181, lng: -5.0078 },
            { id: 'marrakech', name: 'Marrakech', lat: 31.6295, lng: -7.9811 },
            { id: 'tangier', name: 'Tanger', lat: 35.7595, lng: -5.8340 },
            { id: 'oujda', name: 'Oujda', lat: 34.6867, lng: -1.9110 }
        ],
        fr: [ // France
            { id: 'paris', name: 'Paris', lat: 48.8566, lng: 2.3522 },
            { id: 'marseille', name: 'Marseille', lat: 43.2965, lng: 5.3698 },
            { id: 'lyon', name: 'Lyon', lat: 45.7640, lng: 4.8357 },
            { id: 'toulouse', name: 'Toulouse', lat: 43.6047, lng: 1.4442 },
            { id: 'nice', name: 'Nice', lat: 43.7102, lng: 7.2620 },
            { id: 'lille', name: 'Lille', lat: 50.6292, lng: 3.0573 }
        ],
        qa: [ // Qatar
            { id: 'doha', name: 'Doha', lat: 25.2854, lng: 51.5310 },
            { id: 'al_rayyan', name: 'Al Rayyan', lat: 25.2919, lng: 51.4244 },
            { id: 'al_wakrah', name: 'Al Wakrah', lat: 25.1715, lng: 51.5977 },
            { id: 'al_khor', name: 'Al Khor', lat: 25.6809, lng: 51.4987 }
        ],
        dz: [ // Algérie
            { id: 'algiers', name: 'Alger', lat: 36.7538, lng: 3.0588 },
            { id: 'oran', name: 'Oran', lat: 35.6969, lng: -0.6331 },
            { id: 'constantine', name: 'Constantine', lat: 36.3650, lng: 6.6147 },
            { id: 'annaba', name: 'Annaba', lat: 36.9264, lng: 7.7522 }
        ],
        tn: [ // Tunisie
            { id: 'tunis', name: 'Tunis', lat: 36.8065, lng: 10.1815 },
            { id: 'sfax', name: 'Sfax', lat: 34.7398, lng: 10.7600 },
            { id: 'sousse', name: 'Sousse', lat: 35.8245, lng: 10.6346 }
        ],
        tr: [ // Turquie
            { id: 'istanbul', name: 'Istanbul', lat: 41.0082, lng: 28.9784 },
            { id: 'ankara', name: 'Ankara', lat: 39.9334, lng: 32.8597 },
            { id: 'izmir', name: 'Izmir', lat: 38.4237, lng: 27.1428 },
            { id: 'bursa', name: 'Bursa', lat: 40.1885, lng: 29.0610 }
        ],
        id: [ // Indonésie
            { id: 'jakarta', name: 'Jakarta', lat: -6.2088, lng: 106.8456 },
            { id: 'surabaya', name: 'Surabaya', lat: -7.2575, lng: 112.7521 },
            { id: 'bandung', name: 'Bandung', lat: -6.9175, lng: 107.6191 }
        ],
        my: [ // Malaisie
            { id: 'kuala_lumpur', name: 'Kuala Lumpur', lat: 3.1390, lng: 101.6869 },
            { id: 'johor_bahru', name: 'Johor Bahru', lat: 1.4927, lng: 103.7414 },
            { id: 'penang', name: 'Penang', lat: 5.4164, lng: 100.3327 }
        ],
        pk: [ // Pakistan
            { id: 'karachi', name: 'Karachi', lat: 24.8607, lng: 67.0011 },
            { id: 'lahore', name: 'Lahore', lat: 31.5204, lng: 74.3587 },
            { id: 'islamabad', name: 'Islamabad', lat: 33.6844, lng: 73.0479 },
            { id: 'peshawar', name: 'Peshawar', lat: 34.0151, lng: 71.5249 }
        ],
        ae: [ // Émirats Arabes Unis
            { id: 'dubai', name: 'Dubaï', lat: 25.2048, lng: 55.2708 },
            { id: 'abu_dhabi', name: 'Abu Dhabi', lat: 24.4539, lng: 54.3773 },
            { id: 'sharjah', name: 'Sharjah', lat: 25.3461, lng: 55.4211 },
            { id: 'al_ain', name: 'Al Ain', lat: 24.1302, lng: 55.8023 }
        ],
        ps: [ // Palestine
            { id: 'gaza', name: 'Gaza', lat: 31.5017, lng: 34.4668 },
            { id: 'al_quds', name: 'Al-Quds (Jérusalem)', lat: 31.7683, lng: 35.2137 },
            { id: 'ramallah', name: 'Ramallah', lat: 31.9038, lng: 35.2034 },
            { id: 'hebron', name: 'Hébron', lat: 31.5326, lng: 35.0998 },
            { id: 'nablus', name: 'Naplouse', lat: 32.2211, lng: 35.2544 },
            { id: 'bethlehem', name: 'Bethléem', lat: 31.7054, lng: 35.2024 }
        ],
        uk: [ // Royaume-Uni
            { id: 'london', name: 'Londres', lat: 51.5074, lng: -0.1278 },
            { id: 'manchester', name: 'Manchester', lat: 53.4808, lng: -2.2426 },
            { id: 'birmingham', name: 'Birmingham', lat: 52.4862, lng: -1.8904 },
            { id: 'glasgow', name: 'Glasgow', lat: 55.8642, lng: -4.2518 },
            { id: 'leeds', name: 'Leeds', lat: 53.8008, lng: -1.5491 }
        ],
        us: [ // États-Unis
            { id: 'new_york', name: 'New York', lat: 40.7128, lng: -74.0060 },
            { id: 'los_angeles', name: 'Los Angeles', lat: 34.0522, lng: -118.2437 },
            { id: 'chicago', name: 'Chicago', lat: 41.8781, lng: -87.6298 },
            { id: 'houston', name: 'Houston', lat: 29.7604, lng: -95.3698 },
            { id: 'miami', name: 'Miami', lat: 25.7617, lng: -80.1918 },
            { id: 'san_francisco', name: 'San Francisco', lat: 37.7749, lng: -122.4194 }
        ],
        ca: [ // Canada
            { id: 'toronto', name: 'Toronto', lat: 43.6532, lng: -79.3832 },
            { id: 'montreal', name: 'Montréal', lat: 45.5017, lng: -73.5673 },
            { id: 'vancouver', name: 'Vancouver', lat: 49.2827, lng: -123.1207 },
            { id: 'ottawa', name: 'Ottawa', lat: 45.4215, lng: -75.6972 },
            { id: 'calgary', name: 'Calgary', lat: 51.0447, lng: -114.0719 }
        ],
        // Nouveaux pays
        de: [ // Allemagne
            { id: 'berlin', name: 'Berlin', lat: 52.5200, lng: 13.4050 },
            { id: 'munich', name: 'Munich', lat: 48.1351, lng: 11.5820 },
            { id: 'hamburg', name: 'Hambourg', lat: 53.5511, lng: 9.9937 },
            { id: 'cologne', name: 'Cologne', lat: 50.9375, lng: 6.9603 }
        ],
        es: [ // Espagne
            { id: 'madrid', name: 'Madrid', lat: 40.4168, lng: -3.7038 },
            { id: 'barcelona', name: 'Barcelone', lat: 41.3851, lng: 2.1734 },
            { id: 'valencia', name: 'Valence', lat: 39.4699, lng: -0.3763 },
            { id: 'seville', name: 'Séville', lat: 37.3891, lng: -5.9845 }
        ],
        it: [ // Italie
            { id: 'rome', name: 'Rome', lat: 41.9028, lng: 12.4964 },
            { id: 'milan', name: 'Milan', lat: 45.4642, lng: 9.1900 },
            { id: 'naples', name: 'Naples', lat: 40.8518, lng: 14.2681 },
            { id: 'florence', name: 'Florence', lat: 43.7696, lng: 11.2558 }
        ],
        nl: [ // Pays-Bas
            { id: 'amsterdam', name: 'Amsterdam', lat: 52.3676, lng: 4.9041 },
            { id: 'rotterdam', name: 'Rotterdam', lat: 51.9244, lng: 4.4777 },
            { id: 'the_hague', name: 'La Haye', lat: 52.0705, lng: 4.3007 },
            { id: 'utrecht', name: 'Utrecht', lat: 52.0907, lng: 5.1214 }
        ],
        br: [ // Brésil
            { id: 'sao_paulo', name: 'São Paulo', lat: -23.5505, lng: -46.6333 },
            { id: 'rio_de_janeiro', name: 'Rio de Janeiro', lat: -22.9068, lng: -43.1729 },
            { id: 'brasilia', name: 'Brasilia', lat: -15.7801, lng: -47.9292 },
            { id: 'salvador', name: 'Salvador', lat: -12.9714, lng: -38.5014 }
        ],
        mx: [ // Mexique
            { id: 'mexico_city', name: 'Mexico', lat: 19.4326, lng: -99.1332 },
            { id: 'guadalajara', name: 'Guadalajara', lat: 20.6597, lng: -103.3496 },
            { id: 'monterrey', name: 'Monterrey', lat: 25.6866, lng: -100.3161 },
            { id: 'puebla', name: 'Puebla', lat: 19.0414, lng: -98.2063 }
        ],
        au: [ // Australie
            { id: 'sydney', name: 'Sydney', lat: -33.8688, lng: 151.2093 },
            { id: 'melbourne', name: 'Melbourne', lat: -37.8136, lng: 144.9631 },
            { id: 'brisbane', name: 'Brisbane', lat: -27.4698, lng: 153.0251 },
            { id: 'perth', name: 'Perth', lat: -31.9505, lng: 115.8605 }
        ],
        jp: [ // Japon
            { id: 'tokyo', name: 'Tokyo', lat: 35.6762, lng: 139.6503 },
            { id: 'osaka', name: 'Osaka', lat: 34.6937, lng: 135.5023 },
            { id: 'kyoto', name: 'Kyoto', lat: 35.0116, lng: 135.7681 },
            { id: 'yokohama', name: 'Yokohama', lat: 35.4437, lng: 139.6380 }
        ],
        in: [ // Inde
            { id: 'mumbai', name: 'Mumbai', lat: 19.0760, lng: 72.8777 },
            { id: 'delhi', name: 'Delhi', lat: 28.7041, lng: 77.1025 },
            { id: 'bangalore', name: 'Bangalore', lat: 12.9716, lng: 77.5946 },
            { id: 'hyderabad', name: 'Hyderabad', lat: 17.3850, lng: 78.4867 }
        ],
        za: [ // Afrique du Sud
            { id: 'johannesburg', name: 'Johannesburg', lat: -26.2041, lng: 28.0473 },
            { id: 'cape_town', name: 'Le Cap', lat: -33.9249, lng: 18.4241 },
            { id: 'durban', name: 'Durban', lat: -29.8587, lng: 31.0218 },
            { id: 'pretoria', name: 'Pretoria', lat: -25.7461, lng: 28.1881 }
        ],
        ng: [ // Nigéria
            { id: 'lagos', name: 'Lagos', lat: 6.5244, lng: 3.3792 },
            { id: 'kano', name: 'Kano', lat: 12.0022, lng: 8.5920 },
            { id: 'ibadan', name: 'Ibadan', lat: 7.3775, lng: 3.9470 },
            { id: 'abuja', name: 'Abuja', lat: 9.0765, lng: 7.3986 }
        ],
        sn: [ // Sénégal
            { id: 'dakar', name: 'Dakar', lat: 14.7167, lng: -17.4677 },
            { id: 'thies', name: 'Thiès', lat: 14.7833, lng: -16.9167 },
            { id: 'mbour', name: 'Mbour', lat: 14.4167, lng: -16.9667 },
            { id: 'saint_louis', name: 'Saint-Louis', lat: 16.0167, lng: -16.5000 }
        ],
        ir: [ // Iran
            { id: 'tehran', name: 'Téhéran', lat: 35.6892, lng: 51.3890 },
            { id: 'mashhad', name: 'Mashhad', lat: 36.2972, lng: 59.6067 },
            { id: 'isfahan', name: 'Ispahan', lat: 32.6546, lng: 51.6680 },
            { id: 'tabriz', name: 'Tabriz', lat: 38.0962, lng: 46.2738 }
        ],
        ru: [ // Russie
            { id: 'moscow', name: 'Moscou', lat: 55.7558, lng: 37.6173 },
            { id: 'saint_petersburg', name: 'Saint-Pétersbourg', lat: 59.9343, lng: 30.3351 },
            { id: 'novosibirsk', name: 'Novossibirsk', lat: 55.0084, lng: 82.9357 },
            { id: 'yekaterinburg', name: 'Ekaterinbourg', lat: 56.8389, lng: 60.6057 }
        ]
        // Et bien d'autres pays pourraient être ajoutés...
    };
    
    // Function to update cities based on selected country
    function updateCountry() {
        const countrySelect = document.getElementById('country-selector');
        const citySelect = document.getElementById('city-selector');
        const selectedCountry = countrySelect.value;
        
        // Clear current city options
        citySelect.innerHTML = '';
        
        // Reset if no country selected
        if (!selectedCountry) {
            citySelect.innerHTML = '<option value="">Sélectionnez d\'abord un pays</option>';
            citySelect.disabled = true;
            return;
        }
        
        // Get cities for the selected country
        const cities = citiesByCountry[selectedCountry] || [];
        
        // Add default option
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Sélectionnez une ville';
        citySelect.appendChild(defaultOption);
        
        // Add city options
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.id;
            option.setAttribute('data-lat', city.lat);
            option.setAttribute('data-lng', city.lng);
            option.textContent = city.name;
            citySelect.appendChild(option);
        });
        
        // Enable city select
        citySelect.disabled = false;
        
        // Restore previously selected city if applicable
        const savedCountry = localStorage.getItem('prayerTimesSelectedCountry');
        const savedCity = localStorage.getItem('prayerTimesSelectedCity');
        
        if (savedCountry === selectedCountry && savedCity) {
            if ([...citySelect.options].some(opt => opt.value === savedCity)) {
                citySelect.value = savedCity;
                updateCity();
            }
        }
        
        // Save selected country
        localStorage.setItem('prayerTimesSelectedCountry', selectedCountry);
    }
    
    // Function to update prayer times based on selected city
    function updateCity() {
        // Get selected city coordinates
        const citySelect = document.getElementById('city-selector');
        
        // Don't proceed if no city is selected
        if (!citySelect.value) return;
        
        const selectedOption = citySelect.options[citySelect.selectedIndex];
        const lat = selectedOption.getAttribute('data-lat');
        const lng = selectedOption.getAttribute('data-lng');
        
        // Store selected city in local storage
        localStorage.setItem('prayerTimesSelectedCity', citySelect.value);
        
        // Immediately trigger prayer times update with the new coordinates
        updatePrayerTimes();
    }
    
    // Function to ensure dropdown menus have scrollbars when needed
    function setupScrollableDropdowns() {
        // Apply styles to dropdown menus
        const styleDropdown = (element) => {
            if (!element) return;
            // Ensure the dropdown is scrollable when it contains many options
            element.style.maxHeight = '300px';
            element.style.overflowY = 'auto';
        };
        
        // Apply to both country and city selectors
        styleDropdown(document.getElementById('country-selector'));
        styleDropdown(document.getElementById('city-selector'));
    }
    
    // Function to update current prayer display
    function updateCurrentPrayer(timings) {
        const now = new Date();
        const currentTime = now.getHours().toString().padStart(2, '0') + ':' + 
                          now.getMinutes().toString().padStart(2, '0');
        
        const currentPrayer = getCurrentPrayer(timings, currentTime);
        
        // Get French name of the prayer
        const prayerFrench = prayers.find(p => p.name === currentPrayer)?.french || currentPrayer;
        document.getElementById('current-prayer-name').textContent = prayerFrench;
        
        // Highlight current prayer card and check for notification
        const prayerCards = document.querySelectorAll('.prayer-card');
        prayerCards.forEach(card => {
            card.classList.remove('bg-blue-50');
            card.querySelector('.prayer-status').textContent = '';

            // Check for upcoming prayer notification
            const prayerName = card.dataset.prayer;
            const prayerTime = card.dataset.time;
            checkAndTriggerNotification(prayerName, prayerTime);
        });
        
        // Find current and next prayer cards
        const currentCard = document.querySelector(`.prayer-card[data-prayer="${currentPrayer}"]`);
        if (currentCard) {
            currentCard.classList.add('bg-blue-50');
            currentCard.querySelector('.prayer-status').textContent = 'Prière actuelle';
        }
        
        // Determine next prayer and highlight
        const timeToMinutes = time => {
            const [hours, minutes] = time.split(':').map(Number);
            return hours * 60 + minutes;
        };
        
        const allPrayers = ['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
        const prayerMinutes = allPrayers.map(prayer => ({
            prayer,
            minutes: timeToMinutes(timings[prayer])
        }));
        
        // Add next day Fajr
        prayerMinutes.push({
            prayer: 'Fajr',
            minutes: timeToMinutes(timings['Fajr']) + 1440, // Add 24 hours
            nextDay: true
        });
        
        // Sort by time
        prayerMinutes.sort((a, b) => a.minutes - b.minutes);
        
        // Find next prayer
        const currentMinutes = timeToMinutes(currentTime);
        let nextPrayer = null;
        
        for (let i = 0; i < prayerMinutes.length - 1; i++) {
            if (currentMinutes < prayerMinutes[i].minutes) {
                nextPrayer = prayerMinutes[i].prayer;
                break;
            }
        }
        
        if (nextPrayer) {
            const nextCard = document.querySelector(`.prayer-card[data-prayer="${nextPrayer}"]`);
            if (nextCard) {
                nextCard.querySelector('.prayer-status').textContent = 'Prochaine prière';
            }
        }
    }

    // Helper function to get current prayer
    function getCurrentPrayer(timings, currentTime) {
        const prayerTimes = [
            'Fajr',
            'Sunrise',
            'Dhuhr',
            'Asr',
            'Maghrib',
            'Isha'
        ];

        const timeToMinutes = (time) => {
            const [hours, minutes] = time.split(':').map(Number);
            return hours * 60 + minutes;
        };

        const currentMinutes = timeToMinutes(currentTime);
        const prayerMinutes = prayerTimes.map(prayer => ({
            prayer,
            minutes: timeToMinutes(timings[prayer])
        }));

        // Add next day Fajr
        const nextDayFajr = timeToMinutes(timings['Fajr']) + 1440; // 24 hours in minutes
        prayerMinutes.push({ prayer: 'Fajr', minutes: nextDayFajr });

        // Sort prayer times
        prayerMinutes.sort((a, b) => a.minutes - b.minutes);

        // Find current prayer
        for (let i = 0; i < prayerMinutes.length - 1; i++) {
            if (currentMinutes >= prayerMinutes[i].minutes && currentMinutes < prayerMinutes[i + 1].minutes) {
                return prayerMinutes[i].prayer;
            }
        }
        return prayerMinutes[0].prayer; // Default to first prayer if nothing matches
    }

    // Function to check and trigger notification for a specific prayer
    function checkAndTriggerNotification(prayerName, prayerTime) {
        // Get saved notification preferences
        const savedPreferences = JSON.parse(localStorage.getItem('prayerNotificationPreferences')) || {};
        const enabledPrayers = savedPreferences.enabledPrayers || [];
        const minutesBefore = savedPreferences.minutesBefore !== undefined ? savedPreferences.minutesBefore : 15; // Default to 15 minutes

        // Check if notifications are enabled for this prayer and if permission is granted
        if (enabledPrayers.includes(prayerName) && Notification.permission === "granted") {
            const now = new Date();
            const [prayerHour, prayerMinute] = prayerTime.split(':').map(Number);
            const prayerDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), prayerHour, prayerMinute, 0);

            const notificationTime = new Date(prayerDate.getTime() - minutesBefore * 60 * 1000);

            // Check if the current time is within the notification window
            const currentTime = now.getTime();
            if (currentTime >= notificationTime.getTime() && currentTime < prayerDate.getTime()) {
                // Check if notification has already been shown for this prayer and time
                const notificationKey = `notified_${prayerName}_${prayerTime}`;
                if (!localStorage.getItem(notificationKey)) {
                    // Trigger notification
                    triggerNotification(prayerName);

                    // Mark as notified for today
                    localStorage.setItem(notificationKey, 'true');
                }
            }
        }
    }

    // Function to trigger a browser notification
    function triggerNotification(prayerName) {
        const prayerFrench = prayers.find(p => p.name === prayerName)?.french || prayerName;
        const notificationTitle = `C'est l'heure de la prière!`;
        const notificationOptions = {
            body: `${prayerFrench} est dans quelques minutes.`,
            icon: '{{ asset("images/mosque-icon.svg") }}',
            badge: '{{ asset("images/mosque-icon.svg") }}',
            tag: `prayer-${prayerName}`,
            requireInteraction: true
        };

        // Create and show notification
        const notification = new Notification(notificationTitle, notificationOptions);
        
        // Play Adhan sound
        playAdhanSound();
        
        // Close notification after 30 seconds
        setTimeout(() => {
            notification.close();
        }, 30000);
    }

    // Function to play Adhan sound
    function playAdhanSound() {
        const adhanAudio = document.getElementById('adhan-audio');
        if (adhanAudio) {
            // Reset audio to start
            adhanAudio.currentTime = 0;
            // Play the sound
            adhanAudio.play().catch(error => {
                console.error('Error playing Adhan sound:', error);
            });
        }
    }

    // Function to animate all loading dots
    function animateAllLoadingDots() {
        let dots = 0;
        setInterval(() => {
            const loadingDots = document.querySelectorAll('.loading-dots');
            if (loadingDots.length > 0) {
                dots = (dots + 1) % 4;
                const dotsText = '.'.repeat(dots);
                loadingDots.forEach(element => {
                    element.textContent = dotsText;
                });
            }
        }, 500);
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
        // Animer tous les points de suspension
        animateAllLoadingDots();
        // Ensure country and city selectors exist
        const countrySelector = document.getElementById('country-selector');
        const citySelector = document.getElementById('city-selector');

        if (!countrySelector || !citySelector) {
            console.error('Country or city selector not found in the DOM');
            return;
        }

        // Setup scrollable dropdowns
        setupScrollableDropdowns();

        // Load saved country and city preferences from local storage
        const savedCountry = localStorage.getItem('prayerTimesSelectedCountry');
        const savedCity = localStorage.getItem('prayerTimesSelectedCity');

        // Set the country first (if available)
        if (savedCountry) {
            try {
                countrySelector.value = savedCountry;
                console.log('Restored country selection from localStorage:', savedCountry);

                // Populate cities for this country
                updateCountry();

                // Then try to set the city (if available)
                if (savedCity) {
                    try {
                        citySelector.value = savedCity;
                        console.log('Restored city selection from localStorage:', savedCity);
                        updateCity(); // Update prayer times based on this city
                    } catch (e) {
                        console.warn('Could not set saved city:', e);
                    }
                }
            } catch (e) {
                console.warn('Could not set saved country:', e);
            }
        } else {
            // If no saved preferences, select Morocco/Rabat as default
            countrySelector.value = 'ma';
            updateCountry();
            citySelector.value = 'rabat';
            updateCity();
        }

        // Set up refresh intervals
        setInterval(updatePrayerTimes, 15 * 60 * 1000); // Refresh data every 15 minutes
        setInterval(() => {
            const prayerCards = document.querySelectorAll('.prayer-card');
            if (prayerCards.length > 0) {
                // Only update current prayer without fetching new data
                const timings = {};
                prayerCards.forEach(card => {
                    timings[card.dataset.prayer] = card.dataset.time;
                });
                updateCurrentPrayer(timings);
            }
        }, 60 * 1000); // Update current prayer every minute

        // Check for notifications on load as well (in case a prayer time is very soon)
        if (Notification.permission === "granted") {
             const prayerCards = document.querySelectorAll('.prayer-card');
             prayerCards.forEach(card => {
                 const prayerName = card.dataset.prayer;
                 const prayerTime = card.dataset.time;
                 checkAndTriggerNotification(prayerName, prayerTime);
             });
        }
    });

    // Fonction pour configurer les notifications
    async function configureNotifications() {
        // Request permission for notifications
        if (Notification.permission === "default") {
            const permission = await Notification.requestPermission();
            if (permission !== "granted") {
                alert("La permission de notification a été refusée. Vous ne pourrez pas recevoir de notifications.");
                return;
            }
        } else if (Notification.permission === "denied") {
            alert("La permission de notification est bloquée. Veuillez l'activer dans les paramètres de votre navigateur pour recevoir des notifications.");
            return;
        }

        // Créer un élément modal pour configurer les notifications
        const modal = document.createElement('div');
        modal.className = 'notification-modal';
        modal.innerHTML = `
            <div class="notification-modal-content">
                <div class="notification-modal-header">
                    <h3>Configurer les notifications</h3>
                    <button class="notification-modal-close">&times;</button>
                </div>
                <div class="notification-modal-body">
                    <p>Recevez des notifications pour ne jamais manquer une prière.</p>
                    <div class="notification-options">
                        <div class="notification-option">
                            <input type="checkbox" id="notif-fajr" value="Fajr">
                            <label for="notif-fajr">Fajr</label>
                        </div>
                        <div class="notification-option">
                            <input type="checkbox" id="notif-dhuhr" value="Dhuhr">
                            <label for="notif-dhuhr">Dhuhr</label>
                        </div>
                        <div class="notification-option">
                            <input type="checkbox" id="notif-asr" value="Asr">
                            <label for="notif-asr">Asr</label>
                        </div>
                        <div class="notification-option">
                            <input type="checkbox" id="notif-maghrib" value="Maghrib">
                            <label for="notif-maghrib">Maghrib</label>
                        </div>
                        <div class="notification-option">
                            <input type="checkbox" id="notif-isha" value="Isha">
                            <label for="notif-isha">Isha</label>
                        </div>
                        <div class="notification-option">
                            <input type="checkbox" id="notif-sunrise" value="Sunrise">
                            <label for="notif-sunrise">Lever du soleil</label>
                        </div>
                    </div>
                    <div class="notification-timing">
                        <label for="notification-minutes-before">Notifier</label>
                        <select id="notification-minutes-before">
                            <option value="0">À l'heure exacte</option>
                            <option value="5">5 minutes avant</option>
                            <option value="10">10 minutes avant</option>
                            <option value="15" selected>15 minutes avant</option>
                            <option value="30">30 minutes avant</option>
                        </select>
                        <span>avant la prière.</span>
                    </div>
                </div>
                <div class="notification-modal-footer">
                    <button class="notification-save-btn">Enregistrer</button>
                </div>
            </div>
        `;

        // Load saved preferences
        const savedPreferences = JSON.parse(localStorage.getItem('prayerNotificationPreferences')) || {};
        const checkboxes = modal.querySelectorAll('.notification-options input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            if (savedPreferences.enabledPrayers && savedPreferences.enabledPrayers.includes(checkbox.value)) {
                checkbox.checked = true;
            } else {
                checkbox.checked = false;
            }
        });
        const timingSelect = modal.querySelector('#notification-minutes-before');
        if (savedPreferences.minutesBefore !== undefined) {
            timingSelect.value = savedPreferences.minutesBefore;
        }
        
        // Ajouter le modal au document
        document.body.appendChild(modal);

        // Afficher le modal avec une animation
        setTimeout(() => {
            modal.classList.add('active');
        }, 10);

        // Fermer le modal quand on clique sur le bouton de fermeture ou en dehors
        const closeBtn = modal.querySelector('.notification-modal-close');
         modal.addEventListener('click', (e) => {
            if (e.target === modal || e.target === closeBtn) {
                 modal.classList.remove('active');
                setTimeout(() => {
                    document.body.removeChild(modal);
                }, 300);
            }
         });

        // Sauvegarder les paramètres quand on clique sur le bouton d'enregistrement
        const saveBtn = modal.querySelector('.notification-save-btn');
        saveBtn.addEventListener('click', () => {
            const enabledPrayers = [];
            modal.querySelectorAll('.notification-options input[type="checkbox"]:checked').forEach(checkbox => {
                enabledPrayers.push(checkbox.value);
            });
            const minutesBefore = modal.querySelector('#notification-minutes-before').value;

            const preferences = {
                enabledPrayers: enabledPrayers,
                minutesBefore: parseInt(minutesBefore),
            };
            localStorage.setItem('prayerNotificationPreferences', JSON.stringify(preferences));

            alert('Vos paramètres de notification ont été enregistrés!');
            modal.classList.remove('active');
            setTimeout(() => {
                document.body.removeChild(modal);
            }, 300);
        });
    }
</script>

<style>
/* Card styling */
.prayer-card {
    transition: all 0.3s ease;
}
.prayer-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Couleurs de fond des cartes au survol */
.prayer-card[data-prayer="Fajr"]:hover {
    background-color: rgba(99, 102, 241, 0.1); /* Indigo clair */
    border-color: #6366f1;
}

.prayer-card[data-prayer="Sunrise"]:hover {
    background-color: rgba(249, 115, 22, 0.1); /* Orange clair */
    border-color: #f97316;
}

.prayer-card[data-prayer="Dhuhr"]:hover {
    background-color: rgba(245, 158, 11, 0.1); /* Amber clair */
    border-color: #f59e0b;
}

.prayer-card[data-prayer="Asr"]:hover {
    background-color: rgba(16, 185, 129, 0.1); /* Emerald clair */
    border-color: #10b981;
}

.prayer-card[data-prayer="Maghrib"]:hover {
    background-color: rgba(239, 68, 68, 0.1); /* Rouge clair */
    border-color: #ef4444;
}

.prayer-card[data-prayer="Isha"]:hover {
    background-color: rgba(139, 92, 246, 0.1); /* Violet clair */
    border-color: #8b5cf6;
}

/* Styles for animated prayer icons */
.prayer-icon {
    font-size: 1.5rem;
    transition: all 0.5s ease;
    display: inline-block;
}

.prayer-card:hover .prayer-icon {
    transform: scale(1.2) rotate(10deg);
}

/* Specific colors and animations for each prayer */
.prayer-icon-fajr {
    color: #6366f1; /* Indigo */
    animation: twinkle 3s infinite;
    text-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
}

.prayer-icon-sunrise {
    color: #f97316; /* Orange */
    animation: sunrise 3s infinite;
    text-shadow: 0 0 10px rgba(249, 115, 22, 0.5);
}

.prayer-icon-dhuhr {
    color: #f59e0b; /* Amber */
    animation: pulse 3s infinite;
    text-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
}

.prayer-icon-asr {
    color: #10b981; /* Emerald */
    animation: rotate 5s infinite linear;
    text-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
}

.prayer-icon-maghrib {
    color: #ef4444; /* Red */
    animation: sunset 4s infinite;
    text-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
}

.prayer-icon-isha {
    color: #8b5cf6; /* Violet */
    animation: float 3s infinite ease-in-out;
    text-shadow: 0 0 10px rgba(139, 92, 246, 0.5);
}

/* Animation keyframes */
@keyframes twinkle {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(1.2); }
}

@keyframes pulse-text {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.6; }
}

.loading-text {
    animation: pulse-text 2s infinite ease-in-out;
    display: inline-block;
    color: var(--primary-color, #3b82f6);
    font-weight: 500;
}

.loading-dots {
    display: inline-block;
    width: 24px; /* Largeur fixe pour éviter le mouvement */
    text-align: left;
}

/* Styles pour l'icône de notification flottante */
.notification-icon-float {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #4285f4, #34a853);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    z-index: 100;
    transition: all 0.3s ease;
    cursor: pointer;
}

.notification-icon-float:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
}

.notification-icon-float::before {
    content: '';
    position: absolute;
    top: -3px;
    right: -3px;
    width: 15px;
    height: 15px;
    background-color: #ea4335;
    border-radius: 50%;
    border: 2px solid white;
    z-index: 101;
}

.notification-icon-float::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #4285f4, #34a853);
    opacity: 0.6;
    z-index: -1;
    animation: pulse-ring 2s infinite;
}

/* Animation de la cloche */
.notification-bell {
    display: inline-block;
    transition: transform 0.3s ease;
    transform-origin: top center;
    animation: bell-nudge 3s ease-in-out infinite;
}

.bell-container {
    position: relative;
}

.bell-container::after {
    content: '';
    position: absolute;
    top: -3px;
    right: -3px;
    width: 8px;
    height: 8px;
    background-color: #ff4d4d;
    border-radius: 50%;
    border: 1px solid white;
    animation: pulse-dot 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
}

.notification-button:hover .notification-bell {
    animation: bell-ring 0.8s ease infinite;
}

@keyframes bell-nudge {
    0%, 100% { transform: rotate(0); }
    85% { transform: rotate(0); }
    90% { transform: rotate(8deg); }
    95% { transform: rotate(-8deg); }
    97% { transform: rotate(5deg); }
    99% { transform: rotate(-5deg); }
}

@keyframes pulse-dot {
    0% { transform: scale(0.8); opacity: 0.8; }
    50% { transform: scale(1); opacity: 1; }
    100% { transform: scale(0.8); opacity: 0.8; }
}

@keyframes bell-ring {
    0% { transform: rotate(0); }
    20% { transform: rotate(15deg); }
    40% { transform: rotate(-10deg); }
    60% { transform: rotate(5deg); }
    80% { transform: rotate(-5deg); }
    100% { transform: rotate(0); }
}

@keyframes pulse-ring {
    0% { transform: scale(1); opacity: 0.6; }
    50% { transform: scale(1.2); opacity: 0; }
    100% { transform: scale(1); opacity: 0; }
}

/* Styles pour le modal de configuration des notifications */
.notification-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s;
}

.notification-modal.active {
    opacity: 1;
    visibility: visible;
}

.notification-modal-content {
    background-color: white;
    border-radius: 12px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    transform: translateY(20px);
    transition: transform 0.3s;
    overflow: hidden;
}

.notification-modal.active .notification-modal-content {
    transform: translateY(0);
}

.notification-modal-header {
    background: linear-gradient(135deg, #4285f4, #34a853);
    color: white;
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notification-modal-header h3 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
}

.notification-modal-close {
    background: none;
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.2s;
}

.notification-modal-close:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.notification-modal-body {
    padding: 20px;
}

.notification-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin: 15px 0;
}

.notification-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px;
    border-radius: 8px;
    transition: background-color 0.2s;
}

.notification-option:hover {
    background-color: rgba(66, 133, 244, 0.1);
}

.notification-timing {
    margin-top: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.notification-timing select {
    flex: 1;
    padding: 8px 10px;
    border-radius: 6px;
    border: 1px solid #ddd;
    outline: none;
    transition: border-color 0.2s;
}

.notification-timing select:focus {
    border-color: #4285f4;
}

.notification-modal-footer {
    padding: 12px 20px;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: flex-end;
}

.notification-save-btn {
    background-color: #4285f4;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s, transform 0.2s;
}

.notification-save-btn:hover {
    background-color: #3367d6;
    transform: translateY(-2px);
}

.notification-save-btn:active {
    transform: translateY(1px);
}

@keyframes sunrise {
    0% { transform: translateY(0) rotate(0); }
    50% { transform: translateY(-5px) rotate(5deg); }
    100% { transform: translateY(0) rotate(0); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes sunset {
    0% { transform: translateY(0) rotate(0); }
    50% { transform: translateY(5px) rotate(-5deg); }
    100% { transform: translateY(0) rotate(0); }
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

/* Hide any fixed position green bar at bottom */
div[style*="position: fixed"][style*="bottom"],
div[style*="position: sticky"][style*="bottom"],
section[style*="background-color: rgb(226, 255, 237)"],
section[style*="background-color: #e2ffed"] {
    display: none !important;
}

/* Make sure the bottom area has enough margin */
body {
    margin-bottom: 80px; /* Ensure content isn't hidden behind any fixed elements */
}
</style>


@endsection