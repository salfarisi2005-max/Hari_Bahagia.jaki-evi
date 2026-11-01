<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $weddingData['groom']['short_name'] }} & {{ $weddingData['bride']['short_name'] }}</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="Undangan Pernikahan Digital {{ $weddingData['groom']['short_name'] }} & {{ $weddingData['bride']['short_name'] }} - 8 November 2026">
    
    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            100: '#FDF8EC',
                            300: '#E5C882',
                            500: '#D4AF37',
                            700: '#AA820A',
                        },
                        dark: '#121212'
                    },
                    fontFamily: {
                        serif: ['Cinzel', 'serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        .gold-gradient {
            background: linear-gradient(135deg, #BF953F 0%, #FCF6BA 25%, #B38728 50%, #FBF5B7 75%, #AA771C 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-ornament {
            background-image: radial-gradient(#D4AF37 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            opacity: 0.15;
        }
    </style>
    @include('layouts.batik-theme')
</head>
<body class="batik-page bg-stone-50 text-stone-800 font-sans antialiased selection:bg-gold-500 selection:text-white overflow-x-hidden">

    @yield('content')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 1000, once: true });
        });
    </script>
</body>
</html>