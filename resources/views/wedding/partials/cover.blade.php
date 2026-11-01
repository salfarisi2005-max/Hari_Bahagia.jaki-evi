<div id="wedding-cover" class="fixed inset-0 z-50 flex items-center justify-center bg-stone-900 text-white transition-opacity duration-1000">
    <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80')"></div>
    <div class="batik-pattern absolute inset-0 opacity-30"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-stone-900/60 to-transparent"></div>

    <div class="relative z-10 text-center px-6 max-w-lg" data-aos="zoom-in">
        <p class="font-serif tracking-[0.3em] text-xs uppercase text-gold-300 mb-4">The Wedding Of</p>
        <h1 class="font-serif text-3xl md:text-5xl font-bold mb-4 gold-gradient">
            {{ $weddingData['groom']['short_name'] }} <span class="text-xl md:text-3xl text-stone-300">&</span> {{ $weddingData['bride']['short_name'] }}
        </h1>
        <p class="text-stone-300 text-sm tracking-widest mb-8">08 . 11 . 2026</p>

        <div class="bg-stone-800/80 backdrop-blur-md p-6 rounded-2xl border border-gold-500/30 mb-8 shadow-2xl">
            <p class="text-xs text-stone-400 mb-2">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            <h2 class="text-xl font-semibold text-gold-300">{{ $guestName }}</h2>
        </div>

        <button id="btn-open" onclick="openInvitation()" class="inline-flex items-center justify-center gap-2 px-8 py-3 rounded-full bg-gradient-to-r from-gold-700 via-gold-500 to-gold-700 text-stone-900 font-medium text-sm tracking-wide shadow-lg hover:brightness-110 transition duration-300 transform hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-89a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19l9-7 9 7"></path></svg>
            Buka Undangan
        </button>
    </div>
</div>