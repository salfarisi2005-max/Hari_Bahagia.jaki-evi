<section id="gallery" class="scroll-mt-6 py-20 bg-stone-100">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900 mb-2">Galeri Momen</h2>
            <div class="w-16 h-0.5 bg-gold-500 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3" data-aos="fade-up">
            <img src="/images/couple-cartoon.jpg" alt="Ilustrasi kartun Zaki dan Evi sebagai pasangan pengantin" onclick="openModal(this.src)" class="aspect-square w-full rounded-xl bg-white object-contain shadow-md transition duration-300 hover:scale-105">
            <img src="/images/cartoon-couple-navy.jpg" alt="Ilustrasi kartun pasangan pengantin dengan busana biru navy" onclick="openModal(this.src)" class="aspect-square w-full rounded-xl bg-white object-contain shadow-md transition duration-300 hover:scale-105">
            <img src="/images/cartoon-couple-pink.jpg" alt="Ilustrasi kartun pasangan pengantin dengan busana merah muda" onclick="openModal(this.src)" class="aspect-square w-full rounded-xl bg-white object-contain shadow-md transition duration-300 hover:scale-105">
        </div>
    </div>

    <!-- Image Modal -->
    <div id="gallery-modal" class="fixed inset-0 z-50 bg-black/90 hidden items-center justify-center p-4" onclick="closeModal()">
        <img id="modal-img" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl">
    </div>
</section>