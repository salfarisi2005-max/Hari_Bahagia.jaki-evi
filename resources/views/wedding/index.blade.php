@extends('layouts.app')

@section('content')

    <!-- Floating Audio Control -->
    <button id="audio-control" onclick="toggleAudio()" aria-label="Putar atau jeda musik" class="fixed bottom-20 right-4 z-40 flex h-12 w-12 items-center justify-center rounded-full border border-gold-500/30 bg-stone-900/80 text-gold-300 shadow-2xl backdrop-blur transition hover:scale-110 md:bottom-6 md:right-6">
        <svg id="audio-icon-play" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
        <svg id="audio-icon-pause" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
    </button>

    <!-- Background Music: Arti Semestinya Cinta (Lagu Pernikahan Kita) -->
    <audio id="bg-music" loop src="/audio/pernikahan-kita.mp3"></audio>

    <!-- Cover Overlay -->
    @include('wedding.partials.cover')

    <!-- Main Content -->
    <main id="main-content" class="hidden pb-20 md:pb-0">
        @include('wedding.partials.hero')
        @include('wedding.partials.quote')
        @include('wedding.partials.couple')
        @include('wedding.partials.countdown')
        @include('wedding.partials.event')
        @include('wedding.partials.gallery')
        @include('wedding.partials.wishes')
        
        <footer class="py-8 bg-stone-900 text-stone-400 text-center text-xs border-t border-stone-800">
            <p>© 2026 Salman Alfarisi. Dibuat dengan cinta untuk {{ $weddingData['groom']['short_name'] }} & {{ $weddingData['bride']['short_name'] }}.</p>
        </footer>

        <nav aria-label="Navigasi undangan" class="fixed inset-x-0 bottom-0 z-30 border-t border-amber-200/20 bg-stone-900/95 px-2 pb-[env(safe-area-inset-bottom)] text-white shadow-[0_-8px_24px_rgba(0,0,0,0.18)] backdrop-blur-md md:hidden">
            <div class="mx-auto grid max-w-lg grid-cols-5">
                <a class="flex min-h-16 flex-col items-center justify-center gap-1 px-1 text-[10px] font-medium text-amber-100 transition hover:text-white" href="#hero">
                    <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-6v-7h-4v7H4a1 1 0 0 1-1-1V10Z"/></svg>
                    <span>Beranda</span>
                </a>
                <a class="flex min-h-16 flex-col items-center justify-center gap-1 px-1 text-[10px] font-medium text-amber-100 transition hover:text-white" href="#couple">
                    <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm10 10v-2a4 4 0 0 0-3-3.87m-1-11.87a4 4 0 0 1 0 7.75"/></svg>
                    <span>Mempelai</span>
                </a>
                <a class="flex min-h-16 flex-col items-center justify-center gap-1 px-1 text-[10px] font-medium text-amber-100 transition hover:text-white" href="#event">
                    <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2Z"/></svg>
                    <span>Acara</span>
                </a>
                <a class="flex min-h-16 flex-col items-center justify-center gap-1 px-1 text-[10px] font-medium text-amber-100 transition hover:text-white" href="#gallery">
                    <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.8"/><circle cx="8.5" cy="8.5" r="1.5" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 15-5-5L5 21"/></svg>
                    <span>Galeri</span>
                </a>
                <a class="flex min-h-16 flex-col items-center justify-center gap-1 px-1 text-[10px] font-medium text-amber-100 transition hover:text-white" href="#wishes">
                    <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1.1L12 21l7.8-7.5 1.1-1.1a5.5 5.5 0 0 0-.1-7.8Z"/></svg>
                    <span>Ucapan</span>
                </a>
            </div>
        </nav>
    </main>

    <!-- JavaScript Interactions -->
    <script>
        const guestName = new URLSearchParams(window.location.search).get('to')?.trim();
        if (guestName) {
            document.getElementById('guest-name').textContent = guestName;
        }

        const audio = document.getElementById('bg-music');
        let autoScrollFrame = null;
        let autoScrollEnabled = true;
        let completedAudioLoops = 0;
        let previousAudioTime = 0;
        let lastScrollFrame = 0;

        function stopAutoScroll() {
            if (autoScrollFrame !== null) {
                cancelAnimationFrame(autoScrollFrame);
                autoScrollFrame = null;
            }
        }

        function stopAutoScrollForManualNavigation() {
            if (document.getElementById('main-content').classList.contains('hidden')) {
                return;
            }

            autoScrollEnabled = false;
            stopAutoScroll();
        }

        function autoScrollStep(timestamp) {
            if (!autoScrollEnabled || audio.paused) {
                stopAutoScroll();
                return;
            }

            const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
            if (maxScroll <= 0) {
                stopAutoScroll();
                return;
            }

            let targetScroll;
            if (Number.isFinite(audio.duration) && audio.duration > 0) {
                if (audio.currentTime + 0.1 < previousAudioTime) {
                    completedAudioLoops++;
                }

                const elapsedAudioTime = completedAudioLoops * audio.duration + audio.currentTime;
                targetScroll = maxScroll * Math.min(elapsedAudioTime / (audio.duration * 3), 1);
            } else {
                const elapsedSeconds = lastScrollFrame === 0 ? 0 : (timestamp - lastScrollFrame) / 1000;
                targetScroll = Math.min(document.documentElement.scrollTop + elapsedSeconds * 18, maxScroll);
            }

            document.documentElement.scrollTop = targetScroll;
            previousAudioTime = audio.currentTime;
            lastScrollFrame = timestamp;

            if (targetScroll >= maxScroll - 1) {
                stopAutoScroll();
                return;
            }

            autoScrollFrame = requestAnimationFrame(autoScrollStep);
        }

        function startAutoScroll() {
            if (!autoScrollEnabled || audio.paused || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                return;
            }

            stopAutoScroll();
            previousAudioTime = audio.currentTime;
            lastScrollFrame = 0;
            autoScrollFrame = requestAnimationFrame(autoScrollStep);
        }

        window.addEventListener('pointerdown', stopAutoScrollForManualNavigation);
        window.addEventListener('wheel', stopAutoScrollForManualNavigation, { passive: true });
        window.addEventListener('touchstart', stopAutoScrollForManualNavigation, { passive: true });
        window.addEventListener('keydown', function(event) {
            const scrollKeys = ['ArrowDown', 'ArrowUp', 'PageDown', 'PageUp', 'Home', 'End', ' '];
            const activeElement = document.activeElement;
            const isTyping = activeElement && ['INPUT', 'TEXTAREA'].includes(activeElement.tagName);

            if (!isTyping && scrollKeys.includes(event.key)) {
                stopAutoScrollForManualNavigation();
            }
        });

        function openInvitation() {
            const cover = document.getElementById('wedding-cover');
            const main = document.getElementById('main-content');

            cover.classList.add('opacity-0');
            main.classList.remove('hidden');
            document.getElementById('hero').scrollIntoView({ behavior: 'smooth' });
            toggleAudio(true);

            setTimeout(() => {
                cover.classList.add('hidden');
            }, 1000);
        }

        function toggleAudio(forcePlay = false) {
            const playIcon = document.getElementById('audio-icon-play');
            const pauseIcon = document.getElementById('audio-icon-pause');

            if (forcePlay || audio.paused) {
                audio.play().then(() => {
                    playIcon.classList.add('hidden');
                    pauseIcon.classList.remove('hidden');
                    startAutoScroll();
                }).catch(err => {
                    console.log('Autoplay dicegah oleh browser:', err);
                });
            } else {
                audio.pause();
                stopAutoScroll();
                playIcon.classList.remove('hidden');
                pauseIcon.classList.add('hidden');
            }
        }

        // Realtime Countdown Engine (Target: 8 November 2026)
        const targetDate = new Date('2026-11-08T08:00:00').getTime();
        setInterval(() => {
            const now = new Date().getTime();
            const diff = targetDate - now;

            if (diff > 0) {
                document.getElementById('days').innerText = String(Math.floor(diff / (1000 * 60 * 60 * 24))).padStart(2, '0');
                document.getElementById('hours').innerText = String(Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                document.getElementById('minutes').innerText = String(Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                document.getElementById('seconds').innerText = String(Math.floor((diff % (1000 * 60)) / 1000)).padStart(2, '0');
            }
        }, 1000);

        const wishStorageKey = 'wedding-wishes-v1';
        const initialWishes = {{ Illuminate\Support\Js::from($wishes) }};
        const wishForm = document.getElementById('wish-form');
        const wishNameInput = document.getElementById('wish-name');
        const wishMessageInput = document.getElementById('wish-message');
        const wishStatus = document.getElementById('wish-status');
        const wishesContainer = document.getElementById('wishes-container');
        let wishes = [];

        function showWishStatus(message, isError = false) {
            wishStatus.textContent = message;
            wishStatus.className = isError ? 'mt-4 text-sm text-red-700' : 'mt-4 text-sm text-stone-600';
            wishStatus.setAttribute('role', isError ? 'alert' : 'status');
        }

        function persistWishes(nextWishes) {
            try {
                localStorage.setItem(wishStorageKey, JSON.stringify(nextWishes));
                return true;
            } catch (error) {
                showWishStatus('Ucapan tidak dapat disimpan di browser ini. Periksa pengaturan penyimpanan browser.', true);
                return false;
            }
        }

        function parseStoredWishes(value) {
            const storedWishes = JSON.parse(value);
            const isValid = Array.isArray(storedWishes) && storedWishes.every(wish =>
                wish &&
                typeof wish.id === 'string' &&
                typeof wish.name === 'string' &&
                typeof wish.message === 'string'
            );

            if (!isValid) {
                throw new Error('Format ucapan tersimpan tidak valid.');
            }

            return storedWishes;
        }

        function createWishCard(wish) {
            const card = document.createElement('article');
            card.className = 'rounded-xl border border-stone-100 bg-white p-5 shadow';

            const header = document.createElement('div');
            header.className = 'flex flex-wrap items-start justify-between gap-3';

            const name = document.createElement('h3');
            name.className = 'text-sm font-bold text-stone-900';
            name.textContent = wish.name;

            const message = document.createElement('p');
            message.className = 'mt-3 whitespace-pre-wrap text-sm leading-relaxed text-stone-700';
            message.textContent = wish.message;

            header.append(name);
            card.append(header, message);

            return card;
        }

        function renderWishes() {
            wishesContainer.replaceChildren();

            if (wishes.length === 0) {
                const emptyMessage = document.createElement('p');
                emptyMessage.className = 'rounded-xl border border-stone-100 bg-white p-5 text-center text-sm text-stone-500';
                emptyMessage.textContent = 'Belum ada ucapan. Jadilah yang pertama mengirim doa.';
                wishesContainer.append(emptyMessage);
                return;
            }

            wishes.forEach(wish => wishesContainer.append(createWishCard(wish)));
        }

        try {
            const storedWishes = localStorage.getItem(wishStorageKey);
            wishes = storedWishes === null
                ? initialWishes.map((wish, index) => ({ ...wish, id: `initial-${index}` }))
                : parseStoredWishes(storedWishes);

            if (storedWishes === null && !persistWishes(wishes)) {
                wishForm.querySelectorAll('input, textarea, button').forEach(element => {
                    element.disabled = true;
                });
            }

            renderWishes();
        } catch (error) {
            showWishStatus('Ucapan tersimpan tidak dapat dibaca. Hapus data situs untuk memulai ulang penyimpanan ucapan.', true);
            wishForm.querySelectorAll('input, textarea, button').forEach(element => {
                element.disabled = true;
            });
        }

        wishForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const name = wishNameInput.value.trim();
            const message = wishMessageInput.value.trim();

            if (!name || !message) {
                showWishStatus('Nama dan ucapan wajib diisi.', true);
                return;
            }

            const nextWishes = [...wishes, {
                id: typeof crypto.randomUUID === 'function' ? crypto.randomUUID() : `${Date.now()}-${Math.random()}`,
                name,
                message,
            }];

            if (!persistWishes(nextWishes)) {
                return;
            }

            wishes = nextWishes;
            renderWishes();
            wishForm.reset();
            showWishStatus('Ucapan berhasil disimpan di browser ini.');
        });

        window.addEventListener('storage', function(event) {
            if (event.key !== wishStorageKey) {
                return;
            }

            try {
                wishes = event.newValue === null
                    ? initialWishes.map((wish, index) => ({ ...wish, id: `initial-${index}` }))
                    : parseStoredWishes(event.newValue);
                renderWishes();
                showWishStatus('Daftar ucapan diperbarui dari tab lain di browser ini.');
            } catch (error) {
                showWishStatus('Perubahan penyimpanan dari tab lain tidak dapat dibaca.', true);
            }
        });

        function openModal(src) {
            document.getElementById('modal-img').src = src;
            document.getElementById('gallery-modal').classList.remove('hidden');
            document.getElementById('gallery-modal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('gallery-modal').classList.add('hidden');
            document.getElementById('gallery-modal').classList.remove('flex');
        }
    </script>
@endsection