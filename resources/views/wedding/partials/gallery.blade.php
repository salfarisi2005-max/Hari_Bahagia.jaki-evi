<section id="gallery" class="scroll-mt-6 py-20 bg-stone-100">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900 mb-2">Galeri Momen</h2>
            <div class="w-16 h-0.5 bg-gold-500 mx-auto"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4" data-aos="fade-up">
            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=900&q=85" alt="Momen pernikahan yang hangat" onclick="openModal(this.src)" class="w-full h-48 rounded-xl object-cover shadow-md transition duration-300 hover:scale-105">
            <img src="https://images.unsplash.com/photo-1537633552985-df8429e8048b?auto=format&fit=crop&w=900&q=85" alt="Dekorasi dan suasana pernikahan" onclick="openModal(this.src)" class="w-full h-48 rounded-xl object-cover shadow-md transition duration-300 hover:scale-105">
            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=900&q=85" alt="Perayaan hari bahagia" onclick="openModal(this.src)" class="w-full h-48 rounded-xl object-cover shadow-md transition duration-300 hover:scale-105">
        </div>
    </div>

    <!-- Image Modal -->
    <div id="gallery-modal" class="fixed inset-0 z-50 bg-black/90 hidden items-center justify-center p-4" onclick="closeModal()">
        <img id="modal-img" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl">
    </div>
</section>