<?php
// konfigurator.php
// Plik z całą zawartością konfiguratora.

// Tutaj można dodać logikę do wczytywania danych produktów z bazy
// Zamiast tablicy JS, można tutaj generować dane z bazy.
$fabrics = [
    'standard' => [
        ['name' => 'Classic White', 'color' => '#f8fafc', 'surcharge' => 0],
        ['name' => 'Cream', 'color' => '#fef3c7', 'surcharge' => 5],
        ['name' => 'Grey', 'color' => '#e2e8f0', 'surcharge' => 5],
    ],
    'blackout' => [
        ['name' => 'Black', 'color' => '#000000', 'surcharge' => 20],
        ['name' => 'Navy Blue', 'color' => '#1e3a8a', 'surcharge' => 25],
    ],
    'thermo' => [
        ['name' => 'Silver', 'color' => '#d1d5db', 'surcharge' => 30],
        ['name' => 'Gold', 'color' => '#fcd34d', 'surcharge' => 35],
    ],
    'dimming' => [
        ['name' => 'Anthracite', 'color' => '#374151', 'surcharge' => 15],
        ['name' => 'Beige', 'color' => '#f5f5dc', 'surcharge' => 10],
    ],
];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Konfigurator Plis</title>
    <style>
        .profile-btn.selected {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px #3b82f6;
        }
        .fabric-category-btn.selected {
            border-color: #3b82f6;
            background-color: #eff6ff;
            color: #3b82f6;
        }
    </style>
</head>
<body>
    <section id="konfigurator-page" class="py-16 px-4">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Stwórz własne plisy na wymiar</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Lewa kolumna: podgląd i podsumowanie -->
                <div class="col-span-1 md:col-span-1 p-6 bg-white rounded-xl shadow-md">
                    <div class="bg-slate-200 h-64 rounded-lg mb-6 flex items-center justify-center text-slate-500 font-semibold">
                        Podgląd plisy
                    </div>
                    <h3 class="text-xl font-bold mb-4">Podsumowanie zamówienia</h3>
                    <div class="space-y-2 text-slate-600">
                        <p>Wymiary: <span id="summary-dimensions" class="font-semibold text-slate-800">0 x 0 cm</span></p>
                        <p>Profil: <span id="summary-profile" class="font-semibold text-slate-800">-</span></p>
                        <p>Kategoria tkaniny: <span id="summary-fabric-category" class="font-semibold text-slate-800">-</span></p>
                        <p>Nazwa tkaniny: <span id="summary-fabric-name" class="font-semibold text-slate-800">-</span></p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200">
                        <p class="text-xl font-bold flex justify-between items-center">
                            Całkowita cena: <span id="final-price" class="text-blue-600 text-3xl font-extrabold">0.00 zł</span>
                        </p>
                        <button id="add-to-cart-btn" class="w-full bg-blue-600 text-white px-5 py-3 mt-4 rounded-lg font-bold hover:bg-blue-700 transition-all" disabled>
                            Dodaj do koszyka
                        </button>
                    </div>
                </div>

                <!-- Prawa kolumna: opcje konfiguracji -->
                <div class="col-span-1 md:col-span-2 p-6 bg-white rounded-xl shadow-md">
                    <!-- Krok 1: Wymiary -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">1. Wymiary</h3>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div>
                                <label for="width" class="block text-sm font-medium text-slate-700 mb-1">Szerokość (cm)</label>
                                <input type="number" id="width" min="30" max="200" value="30" class="w-full p-3 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <p id="width-error" class="text-red-500 text-xs mt-1 hidden">Min. 30 cm, Max. 200 cm</p>
                            </div>
                            <div>
                                <label for="height" class="block text-sm font-medium text-slate-700 mb-1">Wysokość (cm)</label>
                                <input type="number" id="height" min="30" max="230" value="30" class="w-full p-3 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <p id="height-error" class="text-red-500 text-xs mt-1 hidden">Min. 30 cm, Max. 230 cm</p>
                            </div>
                        </div>
                    </div>

                    <!-- Krok 2: Kolor profilu (zaktualizowany z obrazkami i lupą) -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">2. Kolor profilu</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            <!-- Profile Cosimo z obrazkami -->
                            <button data-type="profile" data-value="Cosimo Biały" data-surcharge="0" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-bialy.png" alt="Profil Cosimo Biały" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo Biały</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo Antracyt" data-surcharge="10" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-antracyt.png" alt="Profil Cosimo Antracyt" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo Antracyt (+10 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo Srebrny" data-surcharge="5" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-srebrny.png" alt="Profil Cosimo Srebrny" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo Srebrny (+5 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo Dąb Jasny" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-dab-jasny.png" alt="Profil Cosimo Dąb Jasny" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo Dąb Bagienny (+15 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo Orzech" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-orzech.png" alt="Profil Cosimo Orzech" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo Orzech (+15 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo Mahoń" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-mahon.png" alt="Profil Cosimo Mahoń" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo Mahoń (+15 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo Złoty Dąb" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-zloty-dab.png" alt="Profil Cosimo Złoty Dąb" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo Złoty Dąb (+15 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo Winchester" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-winchester.png" alt="Profil Cosimo Winchester" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo Winchester (+15 zł)</p>
                            </button>
                            <!-- Profile Cosimo One z obrazkami -->
                            <button data-type="profile" data-value="Cosimo One Biały" data-surcharge="0" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-one-bialy.png" alt="Profil Cosimo One Biały" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo One Biały</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo One Antracyt" data-surcharge="10" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-one-antracyt.png" alt="Profil Cosimo One Antracyt" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo One Antracyt (+10 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo One Srebrny" data-surcharge="5" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-one-srebrny.png" alt="Profil Cosimo One Srebrny" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo One Srebrny (+5 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo One Dąb Jasny" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-one-dab-jasny.png" alt="Profil Cosimo One Dąb Jasny" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo One Dąb Jasny (+15 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo One Orzech" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-one-orzech.png" alt="Profil Cosimo One Orzech" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo One Orzech (+15 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo One Mahoń" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-one-mahon.png" alt="Profil Cosimo One Mahoń" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo One Mahoń (+15 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo One Złoty Dąb" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-one-zloty-dab.png" alt="Profil Cosimo One Złoty Dąb" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo One Złoty Dąb (+15 zł)</p>
                            </button>
                            <button data-type="profile" data-value="Cosimo One Winchester" data-surcharge="15" class="profile-btn relative p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors pt-8">
                                <ion-icon name="search-outline" class="absolute top-2 right-2 text-gray-500 hover:text-blue-500 transition-colors cursor-pointer text-xl" data-action="preview"></ion-icon>
                                <img src="image/profile/cosimo-one-winchester.png" alt="Profil Cosimo One Winchester" class="w-full h-12 object-contain mb-2 rounded-lg">
                                <p class="font-semibold text-sm">Cosimo One Winchester (+15 zł)</p>
                            </button>
                        </div>
                    </div>

                    <!-- Krok 3: Tkanina -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">3. Wybierz rodzaj tkaniny</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <button data-fabric-type="standard" class="fabric-category-btn p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors">
                                <ion-icon name="list-outline" class="text-4xl text-slate-500 mb-2"></ion-icon>
                                <p class="font-semibold text-sm">Standard</p>
                            </button>
                            <button data-fabric-type="blackout" class="fabric-category-btn p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors">
                                <ion-icon name="moon-outline" class="text-4xl text-slate-500 mb-2"></ion-icon>
                                <p class="font-semibold text-sm">Blackout</p>
                            </button>
                            <button data-fabric-type="thermo" class="fabric-category-btn p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors">
                                <ion-icon name="sunny-outline" class="text-4xl text-slate-500 mb-2"></ion-icon>
                                <p class="font-semibold text-sm">Thermo</p>
                            </button>
                            <button data-fabric-type="dimming" class="fabric-category-btn p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors">
                                <ion-icon name="remove-circle-outline" class="text-4xl text-slate-500 mb-2"></ion-icon>
                                <p class="font-semibold text-sm">Zaciemniające</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal podglądu profilu -->
    <div id="profile-preview-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900 bg-opacity-75 hidden">
        <div class="relative bg-white rounded-lg p-6 max-w-lg w-full shadow-xl">
            <button id="close-profile-modal-btn" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition-colors">
                <ion-icon name="close-circle-outline" class="text-3xl"></ion-icon>
            </button>
            <h3 class="text-2xl font-bold text-center mb-4">Podgląd profilu</h3>
            <img id="profile-preview-image" src="" alt="Powiększony podgląd profilu" class="w-full h-auto rounded-lg mb-4">
            <p id="profile-preview-name" class="text-center font-semibold text-lg text-gray-700"></p>
        </div>
    </div>

    <!-- Modal wyboru tkaniny -->
    <div id="fabric-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900 bg-opacity-75 hidden">
        <div class="relative bg-white rounded-lg p-6 max-w-2xl w-full shadow-xl">
            <button id="close-fabric-modal-btn" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition-colors">
                <ion-icon name="close-circle-outline" class="text-3xl"></ion-icon>
            </button>
            <h3 id="fabric-modal-title" class="text-2xl font-bold text-center mb-6">Wybierz tkaninę</h3>
            <div id="fabric-swatches-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-h-96 overflow-y-auto">
                <!-- Tkaniny będą generowane tutaj -->
            </div>
        </div>
    </div>

    <!-- Modal "Dodano do koszyka" -->
    <div id="add-to-cart-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900 bg-opacity-75 hidden">
        <div class="relative bg-white rounded-lg p-6 max-w-sm w-full text-center shadow-xl">
            <button id="close-add-to-cart-modal-btn" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition-colors">
                <ion-icon name="close-circle-outline" class="text-3xl"></ion-icon>
            </button>
            <ion-icon name="checkmark-circle-outline" class="text-green-500 text-6xl mb-4"></ion-icon>
            <h3 class="text-2xl font-bold mb-2">Dodano do koszyka!</h3>
            <p class="text-slate-600">Twój produkt został pomyślnie dodany.</p>
        </div>
    </div>

    <!-- Skrypty do obsługi całej logiki -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Konfigurator: Skrypt załadowany i DOM gotowy.');

            // Selekcja elementów HTML
            const widthInput = document.getElementById('width');
            const heightInput = document.getElementById('height');
            const summaryDimensions = document.getElementById('summary-dimensions');
            const summaryProfile = document.getElementById('summary-profile');
            const summaryFabricCategory = document.getElementById('summary-fabric-category');
            const summaryFabricName = document.getElementById('summary-fabric-name');
            const finalPrice = document.getElementById('final-price');
            const addToCartBtn = document.getElementById('add-to-cart-btn');

            // Elementy do obsługi podglądu profilu
            const profileButtons = document.querySelectorAll('.profile-btn');
            const profilePreviewModal = document.getElementById('profile-preview-modal');
            const profilePreviewImage = document.getElementById('profile-preview-image');
            const profilePreviewName = document.getElementById('profile-preview-name');
            const closeProfileModalBtn = document.getElementById('close-profile-modal-btn');

            // Dane o tkaninach
            const fabrics = <?php echo json_encode($fabrics); ?>;
            const fabricCategoryButtons = document.querySelectorAll('.fabric-category-btn');
            const fabricModal = document.getElementById('fabric-modal');
            const closeFabricModalBtn = document.getElementById('close-fabric-modal-btn');
            const fabricSwatchesContainer = document.getElementById('fabric-swatches-container');
            const fabricModalTitle = document.getElementById('fabric-modal-title');
            
            // Modal do dodawania do koszyka
            const addToCartModal = document.getElementById('add-to-cart-modal');
            const closeAddToCartModalBtn = document.getElementById('close-add-to-cart-modal-btn');

            // Stan konfiguratora
            let currentSelection = {
                width: 30,
                height: 30,
                profile: { name: null, surcharge: 0 },
                fabric: null
            };

            // Oblicza cenę na podstawie wymiarów i dodatków
            function calculatePrice() {
                const basePricePerCm2 = 0.05; // przykładowa bazowa cena za cm2
                const width = parseFloat(widthInput.value);
                const height = parseFloat(heightInput.value);
                
                if (width < 30 || height < 30) {
                    return 0;
                }

                let price = (width * height * basePricePerCm2);
                price += currentSelection.profile.surcharge || 0;
                price += currentSelection.fabric ? (currentSelection.fabric.surcharge * (width * height / 1000)) : 0; // Przykładowa dopłata za tkaninę

                return price.toFixed(2);
            }

            // Aktualizuje podsumowanie i cenę
            function updateSummary() {
                if (summaryDimensions) summaryDimensions.textContent = `${currentSelection.width} x ${currentSelection.height} cm`;
                if (summaryProfile) summaryProfile.textContent = currentSelection.profile.name || '-';
                if (summaryFabricCategory) summaryFabricCategory.textContent = currentSelection.fabric ? currentSelection.fabric.category : '-';
                if (summaryFabricName) summaryFabricName.textContent = currentSelection.fabric ? currentSelection.fabric.name : '-';
                if (finalPrice) finalPrice.textContent = `${calculatePrice()} zł`;

                // Sprawdź, czy można aktywować przycisk "Dodaj do koszyka"
                if (addToCartBtn) {
                    addToCartBtn.disabled = !currentSelection.fabric || !currentSelection.profile.name || currentSelection.width < 30 || currentSelection.height < 30;
                }
            }
            
            // Funkcja do normalizacji nazwy profilu na nazwę pliku
            function normalizeFilename(name) {
                return name.toLowerCase().replace(/ą/g, 'a').replace(/ć/g, 'c').replace(/ę/g, 'e').replace(/ł/g, 'l').replace(/ń/g, 'n').replace(/ó/g, 'o').replace(/ś/g, 's').replace(/ź/g, 'z').replace(/ż/g, 'z').replace(/ /g, '-');
            }

            // Obsługa kliknięcia na przyciski profili
            profileButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const profileName = button.dataset.value;
                    const surcharge = parseFloat(button.dataset.surcharge);
                    const clickedElement = e.target;

                    // Sprawdź, czy kliknięto ikonę lupy
                    if (clickedElement.closest('[data-action="preview"]')) {
                        // Pokaż modal podglądu, jeśli kliknięto lupę
                        const filename = normalizeFilename(profileName);
                        if (profilePreviewName) profilePreviewName.textContent = profileName;
                        if (profilePreviewImage) {
                            const imagePath = `image/profile/${filename}.png`;
                            profilePreviewImage.src = imagePath;
                            profilePreviewImage.onerror = () => {
                                profilePreviewImage.src = `https://placehold.co/400x300/3b82f6/ffffff?text=Brak+obrazu`;
                            };
                        }
                        if (profilePreviewModal) profilePreviewModal.classList.remove('hidden');
                    } else {
                        // W przeciwnym razie, zaznacz przycisk i zaktualizuj stan
                        profileButtons.forEach(btn => btn.classList.remove('selected'));
                        button.classList.add('selected');
                        currentSelection.profile = { name: profileName, surcharge: surcharge };
                        updateSummary();
                    }
                });
            });

            // Obsługa zamykania modala podglądu profile po kliknięciu w przycisk
            if (closeProfileModalBtn) {
                closeProfileModalBtn.addEventListener('click', () => {
                    profilePreviewModal.classList.add('hidden');
                });
            }

            // Obsługa inputów szerokości i wysokości
            widthInput.addEventListener('input', (e) => {
                currentSelection.width = parseFloat(e.target.value);
                const errorElement = document.getElementById('width-error');
                if (currentSelection.width < 30 || currentSelection.width > 200) {
                    if (errorElement) errorElement.classList.remove('hidden');
                } else {
                    if (errorElement) errorElement.classList.add('hidden');
                }
                updateSummary();
            });

            heightInput.addEventListener('input', (e) => {
                currentSelection.height = parseFloat(e.target.value);
                const errorElement = document.getElementById('height-error');
                if (currentSelection.height < 30 || currentSelection.height > 230) {
                    if (errorElement) errorElement.classList.remove('hidden');
                } else {
                    if (errorElement) errorElement.classList.add('hidden');
                }
                updateSummary();
            });

            // Obsługa kliknięcia na kategorię tkaniny
            fabricCategoryButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const fabricType = button.dataset.fabricType;
                    const fabricsForType = fabrics[fabricType];

                    // Zaznacz przycisk kategorii
                    fabricCategoryButtons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');

                    if (fabricsForType && fabricSwatchesContainer && fabricModalTitle && fabricModal) {
                        fabricModalTitle.textContent = `Wybierz ${button.textContent.trim()} - Tkaninę`;
                        fabricSwatchesContainer.innerHTML = ''; // Wyczyść poprzednie próbki
                        fabricsForType.forEach(fabric => {
                            const swatch = document.createElement('button');
                            swatch.className = 'p-4 border-2 border-slate-200 rounded-lg text-center hover:border-blue-400 transition-colors flex flex-col items-center';
                            swatch.innerHTML = `
                                <div class="w-16 h-16 rounded-full mb-2" style="background-color: ${fabric.color}; border: 1px solid #e2e8f0;"></div>
                                <p class="font-semibold text-sm">${fabric.name}</p>
                                <p class="text-xs text-slate-500">${fabric.surcharge > 0 ? `+${fabric.surcharge} zł` : 'W cenie'}</p>
                            `;
                            swatch.addEventListener('click', () => {
                                currentSelection.fabric = {
                                    category: button.textContent.trim(),
                                    name: fabric.name,
                                    surcharge: fabric.surcharge
                                };
                                updateSummary();
                                fabricModal.classList.add('hidden');
                            });
                            fabricSwatchesContainer.appendChild(swatch);
                        });
                        fabricModal.classList.remove('hidden');
                    }
                });
            });

            // Dodanie do koszyka
            addToCartBtn.addEventListener('click', () => {
                if (currentSelection.fabric && currentSelection.width >= 30 && currentSelection.height >= 30) {
                    // Dodanie produktu do koszyka
                    console.log('Dodano do koszyka:', currentSelection);
                    
                    // Pokaż modal
                    addToCartModal.classList.remove('hidden');
                }
            });
            
            // Obsługa modali
            if (closeAddToCartModalBtn) closeAddToCartModalBtn.addEventListener('click', () => addToCartModal.classList.add('hidden'));
            if (closeFabricModalBtn) closeFabricModalBtn.addEventListener('click', () => fabricModal.classList.add('hidden'));
            
            // Inicjalizacja
            updateSummary();
        });
    </script>
</body>
</html>
