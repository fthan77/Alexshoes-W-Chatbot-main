@extends('layouts.app')

@section('content')
    @php $bg = file_exists(public_path('images/homepage.png')) ? 'images/homepage.png' : 'images/homepage.jpg'; @endphp

    <!-- Hero Section -->
    <section id="home" class="relative min-h-[560px] md:min-h-[640px] lg:min-h-[700px] flex items-center overflow-hidden bg-white">
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="{{ asset($bg) }}" alt="Shoe Background"
                class="w-full h-full object-cover object-center grayscale blur-sm opacity-60 lg:object-right lg:scale-105">
        </div>
        <div class="absolute inset-0 bg-gray-200/20 z-10"></div>
<!-- FLOATING CHAT BUTTON -->
<div id="chatbot-button"
     style="position: fixed; bottom: 20px; right: 20px; 
     background: #0d6efd; color: white; width: 60px; height: 60px;
     border-radius: 50%; display: flex; justify-content: center; 
     align-items: center; cursor: pointer; font-size: 25px; z-index: 9999;">
    💬
</div>

<!-- CHAT WINDOW -->
<div id="chatbot-window"
     style="position: fixed; bottom: 100px; right: 20px; width: 320px; 
     height: 420px; background: white; border-radius: 15px; 
     box-shadow: 0 0 20px rgba(0,0,0,0.2); display: none; 
     flex-direction: column; z-index: 9999;">

    <div style="background:#0d6efd; color:white; padding:15px; border-radius:15px 15px 0 0;">
        <b>Tanya Alex</b>
    </div>

    <div id="chat-content"
         style="flex:1; padding:10px; overflow-y:scroll; font-size:14px;">
    </div>

    <div style="padding:10px; border-top:1px solid #ddd;">
        <input id="chat-input" type="text" placeholder="Ketik pesan..."
               style="width:74%; padding:8px;">
        <button onclick="sendChat()"
                style="width:23%; padding:8px; background:#0d6efd; border:none; color:white;">
            Send
        </button>
    </div>
</div>
<script>
document.getElementById("chatbot-button").onclick = function() {
    let win = document.getElementById("chatbot-window");
    win.style.display = (win.style.display === "none") ? "flex" : "none";
};

function sendChat() {
    let msg = document.getElementById("chat-input").value;
    if (msg.trim() === "") return;

    document.getElementById("chat-content").innerHTML += `
        <div style="text-align:right; margin:5px;">
            <b>Anda:</b> ${msg}
        </div>
    `;

    fetch("/chatbot", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ message: msg })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("chat-content").innerHTML += `
            <div style="text-align:left; margin:5px;">
                <b>Alex:</b> ${data.reply}
            </div>
        `;
    });

    document.getElementById("chat-input").value = "";
}
</script>

        <!-- Content Container - Text di kiri sesuai design -->
        <div class="container mx-auto relative z-20 px-6 md:px-12 lg:px-16 xl:px-20 pt-28 md:pt-32 pb-20 md:pb-24 lg:pb-32">
            <div class="max-w-3xl">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-gray-800 mb-5 md:mb-7 leading-tight tracking-tight">
                    Premium Shoe Washing Service
                </h1>
                <p class="text-gray-700 text-lg md:text-xl mb-8 md:mb-10 max-w-2xl pr-4 md:pr-8">
                    Memberikan perawatan terbaik untuk sepatu kesayangan Anda. Kami menggunakan teknik dan produk berkualitas tinggi untuk membuat sepatu Anda tampak seperti baru kembali.
                </p>

                <!-- Buttons - Spacing sesuai design -->
                <div class="flex flex-col sm:flex-row gap-4 md:gap-6">
                    <a href="https://wa.me/6285720658138"
                        class="inline-block bg-black text-white px-8 md:px-10 lg:px-12 py-3 md:py-4 rounded-md shadow-lg hover:bg-gray-800 transition text-center whitespace-nowrap">
                        Hubungi Kami
                    </a>
                    <a href="#products"
                        class="inline-block bg-transparent border-2 border-black text-black px-8 md:px-10 lg:px-12 py-3 md:py-4 rounded-md hover:bg-black hover:text-white transition text-center whitespace-nowrap">
                        Lihat Layanan
                    </a>
                </div>
            </div>
        </div>


    </section>

    <section id="about" class="w-full bg-neutral-200 pt-8 pb-16">
        <div class="container mx-auto px-4 p-12 min-h-[820px]">
            <h2 class="text-3xl font-semibold text-center">About Us</h2>
            <p class="text-center text-gray-600 text-xl md:text-2xl mt-4 max-w-3xl mx-auto">
                Alex Shoes adalah layanan cuci sepatu profesional yang berkomitmen untuk memberikan perawatan terbaik bagi
                sepatu Anda
            </p>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Mengapa Memilih Kami?</h3>
                    <p class="text-gray-600 leading-relaxed text-xl mb-6" style="text-align: justify;">
                        {!! isset($about) && $about ? nl2br(e($about->description)) : 'Tulis deskripsi About Us di menu admin.' !!}
                    </p>
                </div>

                <div class="md:self-start">
                    <div class="bg-white rounded-3xl shadow p-6 md:p-10 flex items-center justify-center">
                        <img src="{{ asset('images/AlexShoes New Logo (2).png') }}" alt="AlexShoes"
                            class="w-auto h-[120px] md:h-[160] lg:h-[200px] object-contain">
                    </div>
                </div>
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-3xl shadow p-6 text-center fade opacity-0 translate-y-3">
                    <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-gray-700"
                            fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 4l2.6 5.3 5.8.9-4.2 4.1 1 5.8L12 18.4 6.8 20.1l1-5.8-4.2-4.1 5.8-.9L12 4z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold mb-1">Kualitas Premium</h4>
                    <p class="text-gray-600">Menggunakan produk pembersih berkualitas tinggi yang aman untuk semua jenis
                        sepatu</p>
                </div>
                <div class="bg-white rounded-3xl shadow p-6 text-center fade opacity-0 translate-y-3">
                    <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-gray-700"
                            fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 3l7 4v6c0 5-3.5 7-7 8-3.5-1-7-3-7-8V7l7-4z" />
                            <path d="M9.2 12.5l2.1 2.1 3.7-3.7" />
                        </svg>
                    </div>
                    <h4 class="font-semibold mb-1">Perawatan Detail</h4>
                    <p class="text-gray-600">Tim yang berpengalaman dan terlatih dalam merawat berbagai jenis sepatu</p>
                </div>
                <div class="bg-white rounded-3xl shadow p-6 text-center fade opacity-0 translate-y-3">
                    <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-gray-700"
                            fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="8.5" />
                            <path d="M12 7v5l3 2" />
                        </svg>
                    </div>
                    <h4 class="font-semibold mb-1">Tepat Waktu</h4>
                    <p class="text-gray-600">Proses pengerjaan yang efisien tanpa mengorbankan kualitas hasil</p>
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="w-full bg-neutral-300 pt-8 pb-16">
        <div class="container mx-auto px-4 p-12">
                <div class="text-center space-y-3 md:space-y-4 mb-5 md:mb-7">
                <h3 class="text-xl font-semibold">Our Product</h3>
                <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto">
                    Pilih paket layanan yang sesuai dengan kebutuhan sepatu Anda
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @if(isset($products) && $products->count())
                    @foreach($products as $p)
                        <a href="{{ route('product.show', $p->id) }}"
                            class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden hover:scale-[1.02] transition block fade opacity-0 translate-y-3">
                        <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-full h-56 md:h-64 lg:h-72 object-cover" />
                        <div class="p-4">
                            <h4 class="font-bold text-xl tracking-tight text-gray-900">{{ $p->name }}</h4>
                            <p class="mt-2 text-gray-800 font-semibold text-lg tracking-wide">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                            <p class="mt-1 text-gray-600 text-base" style="text-align: justify;">{{ Str::limit($p->description, 100) }}</p>
                        </div>
                    </a>
                @endforeach
                @else
                    <p class="text-center text-gray-600 w-full">Belum ada produk.</p>
                @endif
            </div>
        </div>
    </section>

    <section id="testimonials" class="w-full bg-neutral-100 pt-8 pb-16">
        <div class="container mx-auto px-4 p-12">
                <div class="text-center space-y-3 md:space-y-4 mb-5 md:mb-7">
                <h3 class="text-xl font-semibold">Testimonials</h3>
                <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto">
                    Kepuasan pelanggan adalah prioritas kami
                </p>
            </div>
            @if(isset($testimonials) && $testimonials->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($testimonials as $t)
                    <div class="bg-white rounded-xl shadow p-4 hover:scale-[1.02] transition fade opacity-0 translate-y-3">
                        <div class="flex items-center justify-between">
                            <div class="font-semibold text-lg">{{ $t->name }}</div>
                            <div class="text-yellow-500">{{ str_repeat('★', (int)($t->rating ?? 5)) }}</div>
                        </div>
                        <p class="mt-3 text-gray-700 text-lg" style="text-align: justify;">{{ $t->comment }}</p>
                    </div>
                @endforeach
            </div>
            @else
                <p class="text-center text-gray-600">Belum ada testimonial.</p>
            @endif
        </div>
    </section>

    <footer class="w-full bg-neutral-900 text-gray-300">
        <div class="container mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <img src="{{ asset('images/AlexShoes New Logo (1).png') }}" alt="Alex Shoes"
                    class="h-10 object-contain mb-6">
                <p class="leading-relaxed">Layanan cuci sepatu profesional yang memberikan perawatan terbaik untuk sepatu
                    kesayangan Anda.</p>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#home" class="hover:text-white">Home</a></li>
                    <li><a href="#about" class="hover:text-white">About Us</a></li>
                    <li><a href="#products" class="hover:text-white">Our Products</a></li>
                    <li><a href="#testimonials" class="hover:text-white">Testimonials</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="6" y="2.5" width="12" height="19" rx="2.5" />
                            <path d="M9 5.5h6" />
                            <circle cx="12" cy="18.5" r="0.8" />
                        </svg>
                        <span>085720658138 / 085810786574</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M12 3c3.6 0 6.5 2.9 6.5 6.5 0 5-6.5 10.5-6.5 10.5S5.5 14.5 5.5 9.5C5.5 5.9 8.4 3 12 3z" />
                            <circle cx="12" cy="9.5" r="2.5" />
                        </svg>
                        <span>Perumahan Hasanah Village</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container mx-auto px-4">
            <div class="border-t border-neutral-700"></div>
        </div>

        <div class="container mx-auto px-4 py-6 flex items-center justify-between">
            <div>© {{ date('Y') }} Alex Shoes. All rights reserved.</div>
            <div class="flex items-center gap-3">
                <a href="https://www.instagram.com/alexshoes.id" target="_blank"
                    class="w-9 h-9 rounded-full bg-neutral-800 flex items-center justify-center hover:bg-neutral-700"
                    aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" 
                        viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                </a>
                <a href="https://www.tiktok.com/@alexshoes.id" target="_blank"
                    class="w-9 h-9 rounded-full bg-neutral-800 flex items-center justify-center hover:bg-neutral-700"
                    aria-label="TikTok">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok"
                        viewBox="0 0 16 16">
                        <path
                            d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var selectors = ['#home .max-w-3xl', '#about .grid > div', '#products .grid > *', '#testimonials .grid > *', 'footer .container > *'];
        selectors.forEach(function (sel) {
            document.querySelectorAll(sel).forEach(function (el) {
                if (!el.classList.contains('fade')) {
                    el.classList.add('fade', 'opacity-0', 'translate-y-3');
                }
            });
        });

        var els = document.querySelectorAll('.fade');
        els.forEach(function (el) {
            el.classList.add('transition', 'duration-700', 'ease-out');
        });
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    el.classList.remove('opacity-0', 'translate-y-3');
                    io.unobserve(el);
                }
            });
        }, { threshold: 0.15 });
        els.forEach(function (el) { io.observe(el); });
    });
</script>
