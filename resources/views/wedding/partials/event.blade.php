<section id="event" class="scroll-mt-6 py-20">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900 mb-2">Rangkaian Acara</h2>
            <div class="w-16 h-0.5 bg-gold-500 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Akad Nikah -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gold-100 text-center" data-aos="fade-up">
                <h3 class="font-serif text-2xl font-bold text-gold-700 mb-4">Akad Nikah</h3>
                <p class="text-sm font-semibold text-stone-700 mb-1">Minggu, 08 November 2026</p>
                <p class="text-xs text-stone-500 mb-4">{{ $weddingData['event']['akad']['time'] }}</p>
                <div class="mx-auto mb-6 flex max-w-sm items-start justify-center gap-3 rounded-2xl border border-gold-100 bg-stone-50/80 px-5 py-4 text-left">
                    <span class="mt-0.5 shrink-0 text-gold-700" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z" />
                            <circle cx="12" cy="10" r="2.5" />
                        </svg>
                    </span>
                    <div>
                        <p class="mb-1 text-[10px] font-semibold uppercase tracking-[0.2em] text-gold-700">Lokasi Acara</p>
                        <p class="text-sm font-bold text-stone-800">{{ $weddingData['event']['akad']['location'] }}</p>
                        <p class="mt-1 text-xs leading-relaxed text-stone-500">{{ $weddingData['event']['akad']['address'] }}</p>
                    </div>
                </div>
                <a href="{{ $weddingData['event']['akad']['gmaps'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full border border-gold-500 px-6 py-2.5 text-xs font-semibold text-gold-700 shadow-sm transition hover:bg-gold-500 hover:text-white">
                    Lihat Lokasi
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M7 7h10v10" />
                    </svg>
                </a>
            </div>

            <!-- Resepsi -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gold-100 text-center" data-aos="fade-up" data-aos-delay="100">
                <h3 class="font-serif text-2xl font-bold text-gold-700 mb-4">Resepsi</h3>
                <p class="text-sm font-semibold text-stone-700 mb-1">Minggu, 08 November 2026</p>
                <p class="text-xs text-stone-500 mb-4">{{ $weddingData['event']['resepsi']['time'] }}</p>
                <div class="mx-auto mb-6 flex max-w-sm items-start justify-center gap-3 rounded-2xl border border-gold-100 bg-stone-50/80 px-5 py-4 text-left">
                    <span class="mt-0.5 shrink-0 text-gold-700" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z" />
                            <circle cx="12" cy="10" r="2.5" />
                        </svg>
                    </span>
                    <div>
                        <p class="mb-1 text-[10px] font-semibold uppercase tracking-[0.2em] text-gold-700">Lokasi Acara</p>
                        <p class="text-sm font-bold text-stone-800">{{ $weddingData['event']['resepsi']['location'] }}</p>
                        <p class="mt-1 text-xs leading-relaxed text-stone-500">{{ $weddingData['event']['resepsi']['address'] }}</p>
                    </div>
                </div>
                <a href="{{ $weddingData['event']['resepsi']['gmaps'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full border border-gold-500 px-6 py-2.5 text-xs font-semibold text-gold-700 shadow-sm transition hover:bg-gold-500 hover:text-white">
                    Lihat Lokasi
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M7 7h10v10" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>