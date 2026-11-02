<section id="wishes" class="scroll-mt-6 py-20">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900 mb-2">Ucapan & Doa</h2>
            <div class="w-16 h-0.5 bg-gold-500 mx-auto"></div>
        </div>

        @unless ($isStaticExport)
            <form id="wish-form" class="mb-8 rounded-2xl border border-stone-100 bg-white p-6 shadow-xl md:p-8">
            <label for="wish-category" class="mb-2 block text-xs font-semibold uppercase text-stone-600">Kategori Tamu</label>
            <select id="wish-category" name="category" required
                class="mb-5 w-full rounded-lg border border-stone-200 px-4 py-3 text-sm focus:border-amber-500 focus:outline-none">
                @foreach ($wishCategories as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>

            <label for="wish-name" class="mb-2 block text-xs font-semibold uppercase text-stone-600">Nama Anda</label>
            <input id="wish-name" name="name" type="text" maxlength="100" required
                class="mb-5 w-full rounded-lg border border-stone-200 px-4 py-3 text-sm focus:border-amber-500 focus:outline-none"
                placeholder="Nama Anda">

            <label for="wish-message" class="mb-2 block text-xs font-semibold uppercase text-stone-600">Ucapan & Doa</label>
            <textarea id="wish-message" name="message" rows="4" maxlength="1000" required
                class="mb-5 w-full rounded-lg border border-stone-200 px-4 py-3 text-sm focus:border-amber-500 focus:outline-none"
                placeholder="Tuliskan ucapan dan doa terbaik"></textarea>

            <div class="flex flex-wrap gap-3">
                <button id="wish-submit" type="submit"
                    class="rounded-lg bg-stone-900 px-5 py-3 text-sm font-semibold text-amber-200 transition hover:bg-stone-800">
                    Kirim Ucapan
                </button>
            </div>
            <p id="wish-status" class="mt-4 text-sm" role="status" aria-live="polite"></p>
            </form>
        @else
            <p class="mb-8 rounded-2xl border border-stone-100 bg-white p-6 text-center text-sm leading-relaxed text-stone-600 shadow-xl">
                Fitur kirim ucapan memerlukan server aplikasi. Versi Netlify ini hanya menampilkan undangan.
            </p>
        @endunless

        <div id="wishes-container" class="space-y-6" aria-live="polite"></div>
    </div>
</section>