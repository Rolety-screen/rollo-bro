<?php
// footer.php
// Plik zawierający stopkę, modale oraz kod JavaScript.
?>
    </main>

    <!-- Modale -->
    <!-- Modal wyboru tkaniny -->
    <div id="fabric-modal" class="fixed inset-0 bg-slate-900 bg-opacity-75 z-[100] hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-4xl w-full p-6 relative">
            <button id="close-fabric-modal-btn" class="absolute top-4 right-4 text-slate-500 hover:text-slate-800 transition-colors">
                <ion-icon name="close-outline" class="text-3xl"></ion-icon>
            </button>
            <h3 id="fabric-modal-title" class="text-2xl font-bold mb-4">Wybierz tkaninę z kategorii Standard</h3>
            <div id="fabric-swatches-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 overflow-y-auto" style="max-height: 70vh;">
                <!-- Tutaj będą dynamicznie ładowane próbki tkanin -->
            </div>
        </div>
    </div>

    <!-- Modal dodania do koszyka -->
    <div id="add-to-cart-modal" class="fixed inset-0 bg-slate-900 bg-opacity-75 z-[100] hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 relative text-center">
            <button id="close-add-to-cart-modal-btn" class="absolute top-4 right-4 text-slate-500 hover:text-slate-800 transition-colors">
                <ion-icon name="close-outline" class="text-3xl"></ion-icon>
            </button>
            <ion-icon name="checkmark-circle-outline" class="text-7xl text-green-500 mb-4"></ion-icon>
            <h3 class="text-2xl font-bold mb-2">Dodano do koszyka!</h3>
            <p class="text-slate-600">Twój produkt został pomyślnie dodany do koszyka.</p>
        </div>
    </div>
    
    <!-- Stopka -->
    <footer class="bg-slate-900 text-white py-12">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h4 class="text-xl font-bold mb-4">Pliso.</h4>
                <p class="text-slate-400">
                    Szybko, łatwo i na wymiar. Stwórz idealne plisy do swojego domu, korzystając z naszego intuicyjnego konfiguratora.
                </p>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">Przydatne linki</h4>
                <ul class="space-y-2">
                    <li><a href="index.php?page=home" class="text-slate-400 hover:text-blue-500 transition-colors">Strona Główna</a></li>
                    <li><a href="index.php?page=konfigurator" class="text-slate-400 hover:text-blue-500 transition-colors">Konfigurator</a></li>
                    <li><a href="index.php?page=how-to-measure" class="text-slate-400 hover:text-blue-500 transition-colors">Jak mierzyć?</a></li>
                    <li><a href="index.php?page=blog" class="text-slate-400 hover:text-blue-500 transition-colors">Blog</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">Kontakt</h4>
                <p class="text-slate-400">
                    Adres: ul. Przykładowa 12, 00-001 Warszawa<br>
                    Email: kontakt@pliso.pl<br>
                    Telefon: +48 123 456 789
                </p>
            </div>
        </div>
        <div class="container mx-auto px-6 mt-8 pt-8 border-t border-slate-700 text-center text-slate-500 text-sm">
            &copy; 2024 Pliso. Wszelkie prawa zastrzeżone.
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            // Logika menu mobilnego
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Logika konfiguratora (tylko na stronie konfiguratora)
            if (document.getElementById('konfigurator-page')) {
                const widthInput = document.getElementById('width');
                const heightInput = document.getElementById('height');
                const profileOptions = document.querySelectorAll('[data-type="profile"]');
                const fabricCategoryButtons = document.querySelectorAll('.fabric-category-btn');
                const fabricModal = document.getElementById('fabric-modal');
                const closeFabricModalBtn = document.getElementById('close-fabric-modal-btn');
                const fabricModalTitle = document.getElementById('fabric-modal-title');
                const fabricSwatchesContainer = document.getElementById('fabric-swatches-container');
                const addToCartBtn = document.getElementById('add-to-cart-btn');
                const addToCartModal = document.getElementById('add-to-cart-modal');
                const closeAddToCartModalBtn = document.getElementById('close-add-to-cart-modal-btn');

                const summaryDimensions = document.getElementById('summary-dimensions');
                const summaryProfile = document.getElementById('summary-profile');
                const summaryFabricCategory = document.getElementById('summary-fabric-category');
                const summaryFabricName = document.getElementById('summary-fabric-name');
                const finalPrice = document.getElementById('final-price');

                // Dynamiczne dane o tkaninach z PHP
                const fabrics = <?php echo json_encode($fabrics); ?>;
                let currentSelection = {
                    width: 30,
                    height: 30,
                    profile: 'biały',
                    profileSurcharge: 0,
                    fabricCategory: null,
                    fabric: null,
                    fabricSurcharge: 0,
                    basePrice: 0,
                    finalPrice: 0
                };

                const calculateBasePrice = (w, h) => {
                    const area = (w / 100) * (h / 100); // Pole w metrach kwadratowych
                    const baseRate = 100; // Bazowa cena za metr kwadratowy
                    let price = area * baseRate;

                    // Minimalna cena dla małych plis
                    if (price < 50) {
                        price = 50;
                    }

                    return price;
                };

                const updateSummary = () => {
                    currentSelection.width = parseInt(widthInput.value) || 0;
                    currentSelection.height = parseInt(heightInput.value) || 0;

                    summaryDimensions.textContent = `${currentSelection.width} x ${currentSelection.height} cm`;
                    
                    const basePrice = calculateBasePrice(currentSelection.width, currentSelection.height);
                    const finalPriceValue = basePrice + currentSelection.profileSurcharge + currentSelection.fabricSurcharge;
                    finalPrice.textContent = `${finalPriceValue.toFixed(2)} zł`;

                    // Włącz lub wyłącz przycisk dodawania do koszyka
                    if (currentSelection.fabric && currentSelection.width >= 30 && currentSelection.height >= 30) {
                        addToCartBtn.disabled = false;
                        addToCartBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        addToCartBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    } else {
                        addToCartBtn.disabled = true;
                        addToCartBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                        addToCartBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                    }
                };

                // Obsługa zmiany wymiarów
                widthInput.addEventListener('input', updateSummary);
                heightInput.addEventListener('input', updateSummary);

                // Obsługa wyboru profilu
                profileOptions.forEach(button => {
                    button.addEventListener('click', () => {
                        profileOptions.forEach(btn => btn.classList.remove('config-option-active'));
                        button.classList.add('config-option-active');
                        currentSelection.profile = button.dataset.value;
                        currentSelection.profileSurcharge = parseInt(button.dataset.surcharge);
                        summaryProfile.textContent = button.dataset.value;
                        updateSummary();
                    });
                });
                
                // Domyślny wybór profilu
                document.querySelector('[data-type="profile"][data-value="Cosimo Biały"]').click();

                // Obsługa wyboru kategorii tkaniny
                fabricCategoryButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        fabricCategoryButtons.forEach(btn => btn.classList.remove('config-option-active'));
                        button.classList.add('config-option-active');
                        
                        const fabricType = button.dataset.fabricType;
                        currentSelection.fabricCategory = fabricType;
                        summaryFabricCategory.textContent = button.textContent.trim();
                        summaryFabricName.textContent = '-';
                        currentSelection.fabric = null;
                        currentSelection.fabricSurcharge = 0;
                        updateSummary();

                        fabricModalTitle.textContent = `Wybierz tkaninę z kategorii ${button.textContent.trim()}`;
                        fabricSwatchesContainer.innerHTML = '';
                        fabrics[fabricType].forEach(fabric => {
                            const swatch = document.createElement('div');
                            swatch.className = 'fabric-swatch p-4 border rounded-lg text-center transition-all hover:shadow-md';
                            swatch.innerHTML = `
                                <div class="w-full h-16 rounded-md mb-2 border border-slate-200" style="background-color: ${fabric.color};"></div>
                                <p class="font-semibold text-sm">${fabric.name}</p>
                                ${fabric.surcharge > 0 ? `<p class="text-xs text-slate-500">+${fabric.surcharge} zł</p>` : ''}
                            `;
                            
                            swatch.addEventListener('click', () => {
                                document.querySelectorAll('.fabric-swatch').forEach(s => s.classList.remove('selected'));
                                swatch.classList.add('selected');
                                currentSelection.fabric = fabric.name;
                                currentSelection.fabricSurcharge = fabric.surcharge;
                                summaryFabricName.textContent = fabric.name;
                                updateSummary();
                                fabricModal.classList.add('hidden');
                            });
                            fabricSwatchesContainer.appendChild(swatch);
                        });
                        fabricModal.classList.remove('hidden');
                    });
                });

                // Dodanie do koszyka
                const cart = []; // W bardziej zaawansowanej wersji, to będzie zmienna w sesji
                const updateCartUI = () => {
                    const cartCountElement = document.getElementById('cart-count');
                    cartCountElement.textContent = cart.length;
                };

                addToCartBtn.addEventListener('click', () => {
                    if (currentSelection.fabric && currentSelection.width >= 30 && currentSelection.height >= 30) {
                        cart.push({ ...currentSelection, price: parseFloat(finalPrice.textContent) });
                        updateCartUI();
                        addToCartModal.classList.remove('hidden');
                    }
                });
                
                // Obsługa modali
                closeAddToCartModalBtn.addEventListener('click', () => addToCartModal.classList.add('hidden'));
                closeFabricModalBtn.addEventListener('click', () => fabricModal.classList.add('hidden'));
                
                // Inicjalizacja
                updateSummary();
                updateCartUI();
            }
        });
    </script>
</body>
</html>
