<?php
// home.php
// Plik zawierający treść strony głównej.
?>
        <!-- Sekcja Hero -->
        <div class="hero-bg text-white h-screen flex items-center">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-4 animate-fade-in-up">
                    Idealne plisy na wymiar
                </h1>
                <p class="text-xl md:text-2xl font-medium mb-8 animate-fade-in-up delay-200">
                    Stwórz żaluzje plisowane, które idealnie pasują do Twojego wnętrza.
                </p>
                <a href="index.php?page=konfigurator" class="nav-link bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition-all animate-fade-in-up delay-400">
                    Przejdź do Konfiguratora
                </a>
            </div>
        </div>

        <!-- Sekcja O nas -->
        <section id="about" class="py-20 bg-slate-100">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Dlaczego my?</h2>
                <p class="text-lg text-slate-600 max-w-3xl mx-auto">
                    Oferujemy najwyższej jakości żaluzje plisowane, które są łatwe w montażu i dostępne w setkach wzorów i kolorów. Nasze produkty to gwarancja trwałości i funkcjonalności.
                </p>
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-8 bg-white rounded-xl shadow-md">
                        <ion-icon name="cube-outline" class="text-6xl text-blue-600 mb-4"></ion-icon>
                        <h3 class="text-xl font-semibold mb-2">Jakość premium</h3>
                        <p class="text-slate-600">Używamy tylko najlepszych materiałów, aby zapewnić trwałość i elegancki wygląd na lata.</p>
                    </div>
                    <div class="p-8 bg-white rounded-xl shadow-md">
                        <ion-icon name="color-palette-outline" class="text-6xl text-blue-600 mb-4"></ion-icon>
                        <h3 class="text-xl font-semibold mb-2">Setki wzorów</h3>
                        <p class="text-slate-600">Dopasuj idealny kolor i wzór do każdego wnętrza dzięki naszej szerokiej ofercie tkanin.</p>
                    </div>
                    <div class="p-8 bg-white rounded-xl shadow-md">
                        <ion-icon name="hammer-outline" class="text-6xl text-blue-600 mb-4"></ion-icon>
                        <h3 class="text-xl font-semibold mb-2">Łatwy montaż</h3>
                        <p class="text-slate-600">Nasze plisy są projektowane z myślą o prostym i szybkim montażu, który wykonasz samodzielnie.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sekcja Blog -->
        <section id="blog-preview" class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-slate-900 text-center mb-12">Blog</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-xl">
                        <img src="https://placehold.co/600x400/3b82f6/ffffff?text=Plisy" alt="Tytuł artykułu blogowego 1" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2">Jak wybrać idealne plisy do salonu?</h3>
                            <p class="text-slate-600 text-sm mb-4">Poznaj najlepsze wskazówki dotyczące doboru plis do Twojego salonu. Od materiałów po kolory...</p>
                            <a href="index.php?page=blog" class="text-blue-600 font-semibold hover:underline">Czytaj dalej &rarr;</a>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-xl">
                        <img src="https://placehold.co/600x400/3b82f6/ffffff?text=Montaz" alt="Tytuł artykułu blogowego 2" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2">Montaż plis bezinwazyjny - krok po kroku</h3>
                            <p class="text-slate-600 text-sm mb-4">Nasz przewodnik pokaże Ci, jak w prosty sposób zamontować plisy, bez wiercenia w oknach.</p>
                            <a href="index.php?page=blog" class="text-blue-600 font-semibold hover:underline">Czytaj dalej &rarr;</a>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-xl">
                        <img src="https://placehold.co/600x400/3b82f6/ffffff?text=Kolory" alt="Tytuł artykułu blogowego 3" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2">Nowe trendy kolorystyczne na 2024</h3>
                            <p class="text-slate-600 text-sm mb-4">Odkryj najnowsze trendy i kolory, które odmienią Twoje wnętrza w nadchodzącym roku.</p>
                            <a href="index.php?page=blog" class="text-blue-600 font-semibold hover:underline">Czytaj dalej &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
