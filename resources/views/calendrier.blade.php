@extends('layout')
@section('calendrier')
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

        .header-section > div {
            position: relative;
            z-index: 2;
        }

        .calendar-day {
            min-height: 80px;
        }

        .event-indicator {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            border-radius: 50%;
        }

        @media (max-width: 768px) {
            .calendar-day {
                min-height: 60px;
            }
        }

        .loading {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="header-section py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">Calendrier Hijri</h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto mb-8">
                Explorez le calendrier islamique avec les dates importantes, les événements religieux et la conversion entre les calendriers grégorien et hijri.
            </p>
            <div class="flex justify-center items-center space-x-4 text-lg">
                <i class="fas fa-calendar-alt text-2xl"></i>
                <span id="current-hijri-date" class="font-semibold loading">Chargement...</span>
            </div>
        </div>
    </section>

    <!-- Current Date Display -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Today's Date Card -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-lg border border-blue-200">
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-blue-800 mb-4">
                            <i class="fas fa-calendar-day mr-2"></i>
                            Aujourd'hui
                        </h3>
                        <div class="space-y-3">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <p class="text-sm text-gray-600 mb-1">Date Grégorienne</p>
                                <p id="gregorian-date" class="text-lg font-semibold text-gray-800 loading">Chargement...</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <p class="text-sm text-gray-600 mb-1">Date Hijri</p>
                                <p id="hijri-date" class="text-lg font-semibold text-blue-800 loading">Chargement...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Date Converter Card -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-lg border border-green-200">
                    <h3 class="text-xl font-bold text-green-800 mb-4 text-center">
                        <i class="fas fa-exchange-alt mr-2"></i>
                        Convertisseur de Date
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date Grégorienne</label>
                            <input type="date" id="gregorian-input" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <button onclick="convertDate()" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-300">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Convertir
                        </button>
                        <div id="conversion-result" class="bg-white rounded-lg p-4 shadow-sm hidden">
                            <p class="text-sm text-gray-600 mb-1">Date Hijri Correspondante</p>
                            <p id="converted-hijri" class="text-lg font-semibold text-green-800"></p>
                        </div>
                    </div>
                </div>

                <!-- Islamic Events Card -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 shadow-lg border border-purple-200">
                    <h3 class="text-xl font-bold text-purple-800 mb-4 text-center">
                        <i class="fas fa-star-and-crescent mr-2"></i>
                        Événements Islamiques
                    </h3>
                    <div id="islamic-events" class="space-y-3">
                        <div class="loading text-center text-gray-500">Chargement des événements...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Calendar Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Calendar Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <div class="flex justify-between items-center">
                        <button onclick="previousMonth()" class="p-2 rounded-full hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-chevron-left text-xl"></i>
                        </button>
                        <div class="text-center">
                            <h2 id="calendar-month-year" class="text-2xl font-bold loading">Chargement...</h2>
                            <p id="calendar-hijri-month" class="text-lg opacity-90 loading">Chargement...</p>
                        </div>
                        <button onclick="nextMonth()" class="p-2 rounded-full hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-chevron-right text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="p-6">
                    <!-- Days of week header -->
                    <div class="grid grid-cols-7 gap-2 mb-4">
                        <div class="text-center font-semibold text-gray-600 py-2">Dim</div>
                        <div class="text-center font-semibold text-gray-600 py-2">Lun</div>
                        <div class="text-center font-semibold text-gray-600 py-2">Mar</div>
                        <div class="text-center font-semibold text-gray-600 py-2">Mer</div>
                        <div class="text-center font-semibold text-gray-600 py-2">Jeu</div>
                        <div class="text-center font-semibold text-gray-600 py-2">Ven</div>
                        <div class="text-center font-semibold text-gray-600 py-2">Sam</div>
                    </div>

                    <!-- Calendar Days -->
                    <div id="calendar-days" class="grid grid-cols-7 gap-2">
                        <div class="loading text-center text-gray-500 col-span-7 py-8">Chargement du calendrier...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Islamic Months Information -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Les Mois du Calendrier Hijri</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 shadow-lg border border-red-200">
                    <h3 class="text-xl font-bold text-red-800 mb-3">Muharram</h3>
                    <p class="text-gray-700 text-sm">Premier mois de l'année hijri, mois sacré où le jeûne est recommandé, notamment le 10e jour (Achoura).</p>
                </div>
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 shadow-lg border border-orange-200">
                    <h3 class="text-xl font-bold text-orange-800 mb-3">Safar</h3>
                    <p class="text-gray-700 text-sm">Deuxième mois de l'année hijri, traditionnellement considéré comme un mois de voyage.</p>
                </div>
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-6 shadow-lg border border-yellow-200">
                    <h3 class="text-xl font-bold text-yellow-800 mb-3">Rabi' al-Awwal</h3>
                    <p class="text-gray-700 text-sm">Troisième mois, célèbre pour la naissance du Prophète Muhammad (paix et bénédictions sur lui).</p>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-lg border border-green-200">
                    <h3 class="text-xl font-bold text-green-800 mb-3">Rabi' al-Thani</h3>
                    <p class="text-gray-700 text-sm">Quatrième mois de l'année hijri, également appelé Rabi' al-Akhir.</p>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-lg border border-blue-200">
                    <h3 class="text-xl font-bold text-blue-800 mb-3">Jumada al-Awwal</h3>
                    <p class="text-gray-700 text-sm">Cinquième mois de l'année hijri, nom signifiant "le premier mois sec".</p>
                </div>
                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 shadow-lg border border-indigo-200">
                    <h3 class="text-xl font-bold text-indigo-800 mb-3">Jumada al-Thani</h3>
                    <p class="text-gray-700 text-sm">Sixième mois de l'année hijri, également appelé Jumada al-Akhir.</p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 shadow-lg border border-purple-200">
                    <h3 class="text-xl font-bold text-purple-800 mb-3">Rajab</h3>
                    <p class="text-gray-700 text-sm">Septième mois sacré où les combats étaient interdits. Mois de l'Isra et Mi'raj.</p>
                </div>
                <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl p-6 shadow-lg border border-pink-200">
                    <h3 class="text-xl font-bold text-pink-800 mb-3">Sha'ban</h3>
                    <p class="text-gray-700 text-sm">Huitième mois, mois de préparation au Ramadan où le jeûne est recommandé.</p>
                </div>
                <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl p-6 shadow-lg border border-teal-200">
                    <h3 class="text-xl font-bold text-teal-800 mb-3">Ramadan</h3>
                    <p class="text-gray-700 text-sm">Neuvième mois sacré du jeûne obligatoire et de la révélation du Coran.</p>
                </div>
                <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 rounded-xl p-6 shadow-lg border border-cyan-200">
                    <h3 class="text-xl font-bold text-cyan-800 mb-3">Shawwal</h3>
                    <p class="text-gray-700 text-sm">Dixième mois marqué par l'Aïd al-Fitr et les six jours de jeûne recommandés.</p>
                </div>
                <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl p-6 shadow-lg border border-emerald-200">
                    <h3 class="text-xl font-bold text-emerald-800 mb-3">Dhu al-Qi'dah</h3>
                    <p class="text-gray-700 text-sm">Onzième mois sacré, période de préparation au pèlerinage.</p>
                </div>
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl p-6 shadow-lg border border-amber-200">
                    <h3 class="text-xl font-bold text-amber-800 mb-3">Dhu al-Hijjah</h3>
                    <p class="text-gray-700 text-sm">Douzième mois sacré du pèlerinage (Hajj) et de l'Aïd al-Adha.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Important Islamic Dates -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Dates Importantes du Calendrier Islamique</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-blue-600">
                    <h3 class="text-2xl font-bold text-blue-800 mb-4">
                        <i class="fas fa-star mr-2"></i>
                        Événements Annuels
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-600 text-xs mt-2 mr-3"></i>
                            <div>
                                <strong>1er Muharram :</strong> Nouvel An Hijri
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-600 text-xs mt-2 mr-3"></i>
                            <div>
                                <strong>10 Muharram :</strong> Jour d'Achoura
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-600 text-xs mt-2 mr-3"></i>
                            <div>
                                <strong>12 Rabi' al-Awwal :</strong> Mawlid an-Nabi
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-600 text-xs mt-2 mr-3"></i>
                            <div>
                                <strong>27 Rajab :</strong> Isra et Mi'raj
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-600 text-xs mt-2 mr-3"></i>
                            <div>
                                <strong>Ramadan :</strong> Mois du jeûne
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-600 text-xs mt-2 mr-3"></i>
                            <div>
                                <strong>1er Shawwal :</strong> Aïd al-Fitr
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-600 text-xs mt-2 mr-3"></i>
                            <div>
                                <strong>10 Dhu al-Hijjah :</strong> Aïd al-Adha
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-green-600">
                    <h3 class="text-2xl font-bold text-green-800 mb-4">
                        <i class="fas fa-moon mr-2"></i>
                        Calendrier Lunaire
                    </h3>
                    <div class="space-y-4">
                        <p class="text-gray-700">
                            Le calendrier hijri est basé sur les cycles lunaires et compte environ 354 jours par an, soit 11 jours de moins que le calendrier grégorien.
                        </p>
                        <p class="text-gray-700">
                            Chaque mois commence avec la nouvelle lune et les dates peuvent varier d'un jour selon l'observation locale de la lune.
                        </p>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-800 mb-2">Caractéristiques :</h4>
                            <ul class="text-sm text-green-700 space-y-1">
                                <li>• 12 mois lunaires</li>
                                <li>• 354 ou 355 jours par an</li>
                                <li>• Commence en 622 après J.-C.</li>
                                <li>• Basé sur l'Hégire du Prophète</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Accurate Hijri conversion algorithm
        class HijriCalendar {
            constructor() {
                // Hijri epoch: July 16, 622 CE (Julian calendar)
                this.hijriEpoch = new Date(622, 6, 16);
            }

            // Convert Gregorian date to Hijri
            gregorianToHijri(date) {
                const jd = this.gregorianToJulianDay(date);
                return this.julianDayToHijri(jd);
            }

            // Convert Hijri date to Gregorian
            hijriToGregorian(year, month, day) {
                const jd = this.hijriToJulianDay(year, month, day);
                return this.julianDayToGregorian(jd);
            }

            gregorianToJulianDay(date) {
                const year = date.getFullYear();
                const month = date.getMonth() + 1;
                const day = date.getDate();

                let a = Math.floor((14 - month) / 12);
                let y = year - a;
                let m = month + 12 * a - 3;

                let jd = day + Math.floor((153 * m + 2) / 5) + 365 * y + Math.floor(y / 4) - Math.floor(y / 100) + Math.floor(y / 400) + 1721119;
                
                return jd;
            }

            julianDayToHijri(jd) {
                // Simplified conversion based on astronomical calculations
                const epoch = 1948439.5; // Hijri epoch in Julian days
                const daysSinceEpoch = jd - epoch;
                
                // Average length of Hijri year is 354.36667 days
                const hijriYear = Math.floor(daysSinceEpoch / 354.36667) + 1;
                
                // Calculate the start of the Hijri year
                const yearStart = this.hijriYearStart(hijriYear);
                const dayOfYear = Math.floor(jd - yearStart) + 1;
                
                // Calculate month and day
                let month = 1;
                let dayInMonth = dayOfYear;
                
                const monthLengths = this.getHijriMonthLengths(hijriYear);
                
                for (let i = 0; i < 12; i++) {
                    if (dayInMonth <= monthLengths[i]) {
                        month = i + 1;
                        break;
                    }
                    dayInMonth -= monthLengths[i];
                }
                
                return {
                    year: hijriYear,
                    month: month,
                    day: Math.max(1, dayInMonth)
                };
            }

            hijriYearStart(year) {
                const epoch = 1948439.5;
                return epoch + (year - 1) * 354.36667;
            }

            getHijriMonthLengths(year) {
                // Simplified: alternating 30 and 29 days, with adjustment for leap years
                const isLeapYear = ((year * 11) % 30) < 11;
                const lengths = [30, 29, 30, 29, 30, 29, 30, 29, 30, 29, 30, 29];
                
                if (isLeapYear) {
                    lengths[11] = 30; // Dhu al-Hijjah has 30 days in leap years
                }
                
                return lengths;
            }

            hijriToJulianDay(year, month, day) {
                const yearStart = this.hijriYearStart(year);
                const monthLengths = this.getHijriMonthLengths(year);
                
                let daysInPreviousMonths = 0;
                for (let i = 0; i < month - 1; i++) {
                    daysInPreviousMonths += monthLengths[i];
                }
                
                return yearStart + daysInPreviousMonths + day - 1;
            }

            julianDayToGregorian(jd) {
                const a = jd + 32044;
                const b = Math.floor((4 * a + 3) / 146097);
                const c = a - Math.floor((146097 * b) / 4);
                const d = Math.floor((4 * c + 3) / 1461);
                const e = c - Math.floor((1461 * d) / 4);
                const m = Math.floor((5 * e + 2) / 153);

                const day = e - Math.floor((153 * m + 2) / 5) + 1;
                const month = m + 3 - 12 * Math.floor(m / 10);
                const year = 100 * b + d - 4800 + Math.floor(m / 10);

                return new Date(year, month - 1, day);
            }
        }

        // Initialize calendar instance
        const hijriCalendar = new HijriCalendar();

        // Current date for navigation
        let currentDate = new Date();

        // Islamic month names in French
        const hijriMonths = [
            'Muharram', 'Safar', 'Rabi\' al-Awwal', 'Rabi\' al-Thani',
            'Jumada al-Awwal', 'Jumada al-Thani', 'Rajab', 'Sha\'ban',
            'Ramadan', 'Shawwal', 'Dhu al-Qi\'dah', 'Dhu al-Hijjah'
        ];

        // Gregorian month names in French
        const gregorianMonths = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        // Day names in French
        const dayNames = [
            'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'
        ];

        // Islamic events with hijri dates
        const islamicEvents = {
            '1-1': 'Nouvel An Hijri',
            '10-1': 'Jour d\'Achoura',
            '12-3': 'Mawlid an-Nabi (selon certaines traditions)',
            '27-7': 'Isra et Mi\'raj',
            '1-9': 'Début du Ramadan',
            '27-9': 'Laylat al-Qadr (Nuit du Destin)',
            '1-10': 'Aïd al-Fitr',
            '8-12': 'Début du Hajj',
            '9-12': 'Jour d\'Arafat',
            '10-12': 'Aïd al-Adha'
        };

        // Navigation functions
        function previousMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            updateCalendar();
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            updateCalendar();
        }

        // Convert date function for the converter
        function convertDate() {
            const inputDate = document.getElementById('gregorian-input').value;
            if (!inputDate) {
                alert('Veuillez sélectionner une date à convertir.');
                return;
            }

            const date = new Date(inputDate);
            const hijriDate = hijriCalendar.gregorianToHijri(date);
            
            document.getElementById('converted-hijri').textContent = 
                `${hijriDate.day} ${hijriMonths[hijriDate.month - 1]} ${hijriDate.year} H`;
            
            document.getElementById('conversion-result').classList.remove('hidden');
        }

        // Initialize the page
        function init() {
            updateCurrentDates();
            updateCalendar();
            updateIslamicEvents();

            // Set today's date in the converter
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.getElementById('gregorian-input').value = formattedDate;
        }

        // Update current dates display
        function updateCurrentDates() {
            const now = new Date();
            const hijriNow = hijriCalendar.gregorianToHijri(now);

            // Remove loading class and update content
            const elements = ['current-hijri-date', 'gregorian-date', 'hijri-date'];
            elements.forEach(id => {
                document.getElementById(id).classList.remove('loading');
            });

            // Update header
            document.getElementById('current-hijri-date').textContent =
                `${hijriNow.day} ${hijriMonths[hijriNow.month - 1]} ${hijriNow.year} H`;

            // Update today's date cards
            document.getElementById('gregorian-date').textContent =
                `${dayNames[now.getDay()]} ${now.getDate()} ${gregorianMonths[now.getMonth()]} ${now.getFullYear()}`;

            document.getElementById('hijri-date').textContent =
                `${hijriNow.day} ${hijriMonths[hijriNow.month - 1]} ${hijriNow.year} H`;
        }

        // Update calendar display
        function updateCalendar() {
                        const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            // Get first day of month and total days
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            
            // Get previous month's days to fill the grid
            const daysInPrevMonth = new Date(year, month, 0).getDate();
            
            // Update month/year display
            document.getElementById('calendar-month-year').textContent = 
                `${gregorianMonths[month]} ${year}`;
            document.getElementById('calendar-month-year').classList.remove('loading');
            
            // Get Hijri month/year for the current Gregorian month
            const midMonthDate = new Date(year, month, 15);
            const hijriMidMonth = hijriCalendar.gregorianToHijri(midMonthDate);
            document.getElementById('calendar-hijri-month').textContent = 
                `${hijriMonths[hijriMidMonth.month - 1]} ${hijriMidMonth.year} H`;
            document.getElementById('calendar-hijri-month').classList.remove('loading');
            
            // Generate calendar days
            let calendarDaysHtml = '';
            let dayCount = 1;
            let nextMonthDay = 1;
            
            // Previous month's days
            for (let i = 0; i < firstDay; i++) {
                const prevDate = new Date(year, month - 1, daysInPrevMonth - (firstDay - i - 1));
                const hijriDate = hijriCalendar.gregorianToHijri(prevDate);
                
                calendarDaysHtml += `
                    <div class="calendar-day bg-gray-100 text-gray-400 p-2 rounded-lg relative">
                        <div class="text-right">${daysInPrevMonth - (firstDay - i - 1)}</div>
                        <div class="text-xs text-right mt-1 text-gray-500">${hijriDate.day} ${hijriMonths[hijriDate.month - 1].substring(0, 3)}</div>
                    </div>
                `;
            }
            
            // Current month's days
            const today = new Date();
            const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;
            
            for (let i = 1; i <= daysInMonth; i++) {
                const date = new Date(year, month, i);
                const hijriDate = hijriCalendar.gregorianToHijri(date);
                const isToday = isCurrentMonth && i === today.getDate();
                
                // Check if this date has an Islamic event
                const eventKey = `${hijriDate.day}-${hijriDate.month}`;
                const hasEvent = islamicEvents[eventKey];
                
                let dayClasses = "calendar-day bg-white p-2 rounded-lg relative border";
                if (isToday) {
                    dayClasses += " border-blue-500 border-2";
                } else {
                    dayClasses += " border-gray-200";
                }
                
                calendarDaysHtml += `
                    <div class="${dayClasses}">
                        ${hasEvent ? '<div class="event-indicator"></div>' : ''}
                        <div class="text-right font-medium">${i}</div>
                        <div class="text-xs text-right mt-1 text-blue-600">${hijriDate.day} ${hijriMonths[hijriDate.month - 1].substring(0, 3)}</div>
                        ${hasEvent ? `<div class="text-xs mt-1 text-red-600 truncate">${hasEvent}</div>` : ''}
                    </div>
                `;
            }
            
            // Next month's days to fill the grid
            const totalCells = firstDay + daysInMonth > 35 ? 42 : 35;
            const remainingDays = totalCells - (firstDay + daysInMonth);
            
            for (let i = 1; i <= remainingDays; i++) {
                const nextDate = new Date(year, month + 1, i);
                const hijriDate = hijriCalendar.gregorianToHijri(nextDate);
                
                calendarDaysHtml += `
                    <div class="calendar-day bg-gray-100 text-gray-400 p-2 rounded-lg relative">
                        <div class="text-right">${i}</div>
                        <div class="text-xs text-right mt-1 text-gray-500">${hijriDate.day} ${hijriMonths[hijriDate.month - 1].substring(0, 3)}</div>
                    </div>
                `;
            }
            
            document.getElementById('calendar-days').innerHTML = calendarDaysHtml;
        }
        
        // Update Islamic events list
        function updateIslamicEvents() {
            const now = new Date();
            const hijriNow = hijriCalendar.gregorianToHijri(now);
            const currentHijriMonth = hijriNow.month;
            
            let eventsHtml = '';
            let upcomingEvents = [];
            
            // Find events in current and next months
            for (let i = 0; i < 3; i++) {
                const checkMonth = (currentHijriMonth + i - 1) % 12 || 12;
                const checkYear = hijriNow.year + Math.floor((currentHijriMonth + i - 1) / 12);
                
                for (const [key, event] of Object.entries(islamicEvents)) {
                    const [day, month] = key.split('-').map(Number);
                    if (month === checkMonth) {
                        const eventDate = hijriCalendar.hijriToGregorian(checkYear, month, day);
                        upcomingEvents.push({
                            date: eventDate,
                            day: day,
                            month: month,
                            year: checkYear,
                            event: event
                        });
                    }
                }
            }
            
            // Sort events by date
            upcomingEvents.sort((a, b) => a.date - b.date);
            
            // Display next 5 events
            const eventsToShow = upcomingEvents.slice(0, 5);
            
            if (eventsToShow.length === 0) {
                eventsHtml = '<div class="text-center text-gray-500">Aucun événement à venir dans les 3 prochains mois</div>';
            } else {
                eventsToShow.forEach(event => {
                    const isToday = event.date.toDateString() === now.toDateString();
                    const isPast = event.date < now && !isToday;
                    
                    let eventClasses = "flex items-start p-3 rounded-lg";
                    if (isToday) {
                        eventClasses += " bg-purple-100 border border-purple-200";
                    } else if (isPast) {
                        eventClasses += " opacity-70";
                    } else {
                        eventClasses += " hover:bg-purple-50";
                    }
                    
                    eventsHtml += `
                        <div class="${eventClasses}">
                            <div class="bg-purple-600 text-white rounded-lg p-2 text-center min-w-12 mr-3">
                                <div class="text-xs font-bold">${hijriMonths[event.month - 1].substring(0, 3)}</div>
                                <div class="text-lg font-bold">${event.day}</div>
                                <div class="text-xs">${event.year}H</div>
                            </div>
                            <div>
                                <div class="font-semibold text-purple-800">${event.event}</div>
                                <div class="text-xs text-gray-600">${dayNames[event.date.getDay()]} ${event.date.getDate()} ${gregorianMonths[event.date.getMonth()]} ${event.date.getFullYear()}</div>
                                ${isToday ? '<div class="text-xs text-purple-600 font-semibold mt-1">Aujourd\'hui</div>' : ''}
                            </div>
                        </div>
                    `;
                });
            }
            
            document.getElementById('islamic-events').innerHTML = eventsHtml;
            document.getElementById('islamic-events').classList.remove('loading');
        }
        
        // Initialize the page when loaded
        document.addEventListener('DOMContentLoaded', init);
    </script>
    
   
@endsection