<section id="wishes" class="scroll-mt-6 py-20">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900 mb-2">Ucapan & Doa</h2>
            <div class="w-16 h-0.5 bg-gold-500 mx-auto"></div>
        </div>

        <div class="space-y-4">
            @foreach ($wishes as $wish)
                <article class="rounded-xl border border-stone-100 bg-white p-5 shadow" data-aos="fade-up">
                    <h3 class="text-sm font-bold text-stone-900">{{ $wish['name'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-stone-700">{{ $wish['message'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>