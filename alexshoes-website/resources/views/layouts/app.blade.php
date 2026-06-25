<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;900&display=swap"
        rel="stylesheet">

    
    @php
        $cssFiles = glob(public_path('build/assets/app-*.css'));
        $jsFiles = glob(public_path('build/assets/app-*.js'));
        $builtCss = isset($cssFiles[0]) ? ('build/assets/'.basename($cssFiles[0])) : null;
        $builtJs = isset($jsFiles[0]) ? ('build/assets/'.basename($jsFiles[0])) : null;
    @endphp
    @if($builtCss)
        <link rel="stylesheet" href="{{ asset($builtCss) }}">
    @endif
    @if($builtJs)
        <script defer src="{{ asset($builtJs) }}"></script>
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-[Nunito_Sans] text-[16px] md:text-[17px]">
    <!-- Header -->
    <header class="bg-black text-white w-full fixed top-0 left-0 right-0 z-50">
        <nav class="container mx-auto px-6 md:px-10 lg:px-14 py-4 flex items-center">
            <img src="{{ asset('images/AlexShoes New Logo (1).png') }}" alt="Alex Shoes Logo" class="h-7 md:h-8 object-contain">
            <div class="hidden md:flex items-center gap-8 text-sm ml-auto">
                <a href="#home" class="text-white hover:text-gray-300">Home</a>
                <a href="#about" class="text-white hover:text-gray-300">About Us</a>
                <a href="#products" class="text-white hover:text-gray-300">Our Product</a>
                <a href="#testimonials" class="text-white hover:text-gray-300">Testimonials</a>
            </div>
            <button id="mobile-menu-btn" class="md:hidden ml-auto text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </nav>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-black px-6 pb-4">
            <a href="#home" class="block py-2 hover:text-gray-300">Home</a>
            <a href="#about" class="block py-2 hover:text-gray-300">About Us</a>
            <a href="#products" class="block py-2 hover:text-gray-300">Our Product</a>
            <a href="#testimonials" class="block py-2 hover:text-gray-300">Testimonials</a>
        </div>
    </header>

    @yield('content')

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
