@extends('layouts.app')

@section('content')
    <section class="w-full bg-neutral-200 pt-24 pb-16">
        <div class="container mx-auto px-4" style="text-align: justify;">
            <div class="mb-6 flex items-center justify-between">
                <a href="{{ route('home') }}#products" class="text-black hover:underline">Kembali</a>
            </div>

            <div class="bg-white rounded-2xl shadow overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 md:items-stretch">
                    <div class="bg-neutral-50 md:h-full">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="w-full h-[360px] md:h-full object-cover object-center">
                    </div>
                    <div class="p-6 md:p-10">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                        <p class="mt-3 text-xl font-semibold text-gray-800">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="mt-5 text-gray-700 leading-relaxed text-base">
                            {{ $product->description }}
                        </div>

                        @if($product->detail_benefits)
                            <div class="mt-8">
                                <h2 class="text-lg font-semibold mb-3">Yang Anda Dapatkan</h2>
                                <div class="text-gray-700 leading-relaxed text-base">{!! nl2br(e($product->detail_benefits)) !!}
                                </div>
                            </div>
                        @endif

                        @if($product->detail_process)
                            <div class="mt-8">
                                <h2 class="text-lg font-semibold mb-3">Proses Pengerjaan</h2>
                                <div class="text-gray-700 leading-relaxed text-base">{!! nl2br(e($product->detail_process)) !!}
                                </div>
                            </div>
                        @endif

                        <div class="mt-8">
                            <a href="https://wa.me/6285720658138 ?text={{ urlencode('Halo, saya mau pesan paket ' . $product->name) }}"
                                class="inline-flex items-center gap-2 bg-black text-white px-6 py-3 rounded-md">
                                <span>Beli via WhatsApp</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
