<?php
// header.php
// Plik zawierający sekcję <head> oraz nagłówek z nawigacją.
// Jest dołączany do każdego pliku.
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tagi -->
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description; ?>">
    <meta name="keywords" content="żaluzje plisowane, plisy, plisy na wymiar, rolety plisowane, plisy okienne, konfigurator plis, plisy bezinwazyjne, plisy blackout">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://twojadomena.pl/">
    <meta property="og:title" content="<?php echo $page_title; ?>">
    <meta property="og:description" content="Szybko i łatwo skonfiguruj idealne plisy do swojego domu.">
    <meta property="og:image" content="https://placehold.co/1200x630/3b82f6/ffffff?text=Pliso.pl">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://twojadomena.pl/">
    <meta property="twitter:title" content="<?php echo $page_title; ?>">
    <meta property="twitter:description" content="Szybko i łatwo skonfiguruj idealne plisy do swojego domu.">
    <meta property="twitter:image" content="https://placehold.co/1200x630/3b82f6/ffffff?text=Pliso.pl">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Ikony (Ionicons) -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        .config-option-active {
            box-shadow: 0 0 0 2px #3b82f6; /* blue-500 */
            border-color: #3b82f6;
        }
        .hero-bg {
            background-image: url('https://placehold.co/1920x1080/0f172a/f8fafc?text=T%C5%82o+Strony+G%C5%82%C3%B3wnej');
            background-size: cover;
            background-position: center;
        }
        .transition-all {
            transition: all 0.3s ease-in-out;
        }
        #fabric-modal-content {
            max-height: 80vh;
        }
        .fabric-swatch {
            cursor: pointer;
            border-radius: 0.5rem;
            border-width: 2px;
            border-color: transparent;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
        .fabric-swatch:hover {
            box-shadow: 0 0 0 2px #60a5fa; /* blue-400 */
        }
        .fabric-swatch.selected {
            box-shadow: 0 0 0 4px #3b82f6; /* blue-500 */
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

    <!-- Nagłówek i Nawigacja -->
    <header class="bg-white/80 backdrop-blur-lg sticky top-0 z-50 shadow-sm">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php?page=home" class="nav-link text-2xl font-bold text-slate-900">Pliso.</a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="index.php?page=home" class="nav-link text-slate-600 hover:text-blue-600 transition-colors">Strona Główna</a>
                <a href="index.php?page=konfigurator" class="nav-link text-slate-600 hover:text-blue-600 transition-colors">Konfigurator</a>
                <a href="index.php?page=how-to-measure" class="nav-link text-slate-600 hover:text-blue-600 transition-colors">Jak Mierzyć?</a>
                <a href="index.php?page=blog" class="nav-link text-slate-600 hover:text-blue-600 transition-colors">Blog</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="index.php?page=checkout" id="cart-button" class="nav-link relative text-slate-600 hover:text-blue-600">
                    <ion-icon name="cart-outline" class="text-3xl"></ion-icon>
                    <span id="cart-count" class="absolute -top-1 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"><?php echo $cart_count; ?></span>
                </a>
                <a href="index.php?page=konfigurator" class="nav-link hidden md:block bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all">
                    Wyceń Plisy
                </a>
                <button id="mobile-menu-button" class="md:hidden text-slate-800">
                    <ion-icon name="menu-outline" class="text-3xl"></ion-icon>
                </button>
            </div>
        </nav>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4">
            <a href="index.php?page=home" class="nav-link block py-2 text-slate-600 hover:text-blue-600">Strona Główna</a>
            <a href="index.php?page=konfigurator" class="nav-link block py-2 text-slate-600 hover:text-blue-600">Konfigurator</a>
            <a href="index.php?page=how-to-measure" class="nav-link block py-2 text-slate-600 hover:text-blue-600">Jak Mierzyć?</a>
            <a href="index.php?page=how-to-install" class="nav-link block py-2 text-slate-600 hover:text-blue-600">Jak Montować?</a>
            <a href="index.php?page=blog" class="nav-link block py-2 text-slate-600 hover:text-blue-600">Blog</a>
            <a href="index.php?page=konfigurator" class="nav-link block mt-4 bg-blue-600 text-white text-center px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all">
                Wyceń Plisy
            </a>
        </div>
    </header>
    <main>
