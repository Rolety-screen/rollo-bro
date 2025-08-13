<?php
// index.php
// To jest główny punkt wejścia na stronę. 
// Odpowiada za dynamiczne ładowanie treści na podstawie parametru 'page' w URL.

// Tutaj można zdefiniować zmienne globalne, które będą dostępne na całej stronie
$page_title = "Rollo-Pro - Żaluzje Plisowane na Wymiar | Konfigurator Online";
$page_description = "Zamów nowoczesne żaluzje plisowane na wymiar. Skorzystaj z naszego intuicyjnego konfiguratora, wybierz spośród setek tkanin i kolorów. Gwarancja jakości i łatwy montaż.";
$cart_count = 0; // W bardziej zaawansowanej wersji, to będzie pochodzić z sesji lub bazy danych

// Prosta logika routingu, decydująca, który plik treści załadować
$current_page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Załadowanie nagłówka
require_once 'header.php';

// Dynamiczne ładowanie treści
switch ($current_page) {
    case 'home':
        require_once 'home.php';
        break;
    case 'konfigurator':
        require_once 'konfigurator.php';
        break;
    case 'how-to-measure':
        // require_once 'how-to-measure.php'; // Ten plik wymaga stworzenia
        break;
    case 'blog':
        // require_once 'blog.php'; // Ten plik wymaga stworzenia
        break;
    default:
        // Strona 404 lub powrót do strony głównej
        require_once 'home.php';
        break;
}

// Załadowanie stopki
require_once 'footer.php';
?>
