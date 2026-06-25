<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="/images/logo.svg" alt="AlexShoes" class="h-8 w-auto">
            <span class="font-semibold text-lg">AlexShoes</span>
        </a>


        <div class="hidden md:flex items-center gap-6">
            <a href="#about" class="hover:text-gray-600">About</a>
            <a href="#products" class="hover:text-gray-600">Products</a>
            <a href="#contact" class="hover:text-gray-600">Contact</a>
            <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-md">Shop Now</a>
        </div>


        <div class="md:hidden">
            <button id="nav-toggle" aria-label="open menu">☰</button>
        </div>
    </div>
</nav>


<script>
    // Simple mobile toggle — optional, you can replace with Alpine or JS Vite app
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('nav-toggle');
        if (!btn) return;
        btn.addEventListener('click', () => {
            alert('Implement mobile menu toggle or use Alpine.js');
        })
    })
</script>