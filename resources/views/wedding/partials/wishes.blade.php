<section id="wishes" class="scroll-mt-6 py-20">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900 mb-2">Ucapan & Doa</h2>
            <div class="w-16 h-0.5 bg-gold-500 mx-auto"></div>
        </div>

        <!-- Form Ucapan -->
        <form id="wish-form" class="bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-stone-100 mb-12" data-aos="fade-up">
            <div class="mb-4">
                <label class="block text-xs font-semibold text-stone-600 uppercase mb-2">Nama Anda</label>
                <input type="text" id="wish-name" required placeholder="Masukkan nama lengkap" class="w-full px-4 py-3 rounded-lg border border-stone-200 focus:outline-none focus:border-gold-500 text-sm">
            </div>
            <div class="mb-6">
                <label class="block text-xs font-semibold text-stone-600 uppercase mb-2">Ucapan & Doa</label>
                <textarea id="wish-message" rows="4" required placeholder="Tuliskan ucapan dan doa restu terbaik Anda" class="w-full px-4 py-3 rounded-lg border border-stone-200 focus:outline-none focus:border-gold-500 text-sm"></textarea>
            </div>
            <button type="submit" id="btn-submit-wish" class="w-full py-3 bg-stone-900 text-gold-300 font-semibold text-sm rounded-lg hover:bg-stone-800 transition">Kirim Ucapan</button>
        </form>

        <!-- Dynamic Wishes List -->
        <div class="space-y-4" id="wishes-container">
            <!-- Diisi otomatis oleh JavaScript (AJAX) -->
        </div>
    </div>
</section>