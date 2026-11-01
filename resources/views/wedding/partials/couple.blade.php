<section id="couple" class="scroll-mt-6 py-20">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900 mb-2">Mempelai</h2>
            <div class="w-16 h-0.5 bg-gold-500 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Pria -->
            <div class="batik-panel text-center p-8 rounded-2xl shadow-xl" data-aos="fade-right">
                <div class="w-40 h-40 mx-auto rounded-full flex items-center justify-center border-4 border-gold-300 shadow-md mb-6 bg-amber-100 text-emerald-900">
                    <span class="font-serif text-5xl font-bold tracking-widest" aria-label="Inisial mempelai pria">{{ $weddingData['groom']['initials'] }}</span>
                </div>
                <h3 class="font-serif text-2xl font-bold text-stone-900 mb-2">{{ $weddingData['groom']['full_name'] }}</h3>
                <p class="text-sm leading-relaxed text-stone-600">Putra {{ $weddingData['groom']['birth_order'] }} dari<br>{{ $weddingData['groom']['father'] }} dan {{ $weddingData['groom']['mother'] }}</p>
            </div>

            <!-- Wanita -->
            <div class="batik-panel text-center p-8 rounded-2xl shadow-xl" data-aos="fade-left">
                <div class="w-40 h-40 mx-auto rounded-full flex items-center justify-center border-4 border-gold-300 shadow-md mb-6 bg-amber-100 text-emerald-900">
                    <span class="font-serif text-5xl font-bold tracking-widest" aria-label="Inisial mempelai wanita">{{ $weddingData['bride']['initials'] }}</span>
                </div>
                <h3 class="font-serif text-2xl font-bold text-stone-900 mb-2">{{ $weddingData['bride']['full_name'] }}</h3>
                <p class="text-sm leading-relaxed text-stone-600">Putri {{ $weddingData['bride']['birth_order'] }} dari<br>{{ $weddingData['bride']['father'] }} dan {{ $weddingData['bride']['mother'] }}</p>
            </div>
        </div>
    </div>
</section>