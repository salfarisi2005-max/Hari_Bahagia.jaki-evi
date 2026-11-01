<style>
    .batik-page {
        position: relative;
        isolation: isolate;
        background-color: #f7f2e7;
        color: #263d35;
    }

    .batik-page::before {
        position: fixed;
        z-index: -1;
        inset: 0;
        background-image:
            repeating-linear-gradient(45deg, transparent 0 15px, rgba(28, 83, 72, 0.1) 15px 16px, transparent 16px 31px),
            repeating-linear-gradient(-45deg, transparent 0 15px, rgba(165, 111, 50, 0.09) 15px 16px, transparent 16px 31px);
        content: "";
        pointer-events: none;
    }

    .batik-page .bg-stone-900 {
        background-color: #173f39;
    }

    .batik-page .bg-stone-800 {
        background-color: #27564c;
    }

    .batik-page .bg-stone-100 {
        background-color: #efe8d8;
    }

    .batik-page .bg-stone-50 {
        background-color: #f8f3e7;
    }

    .batik-page .bg-white {
        background-color: #fffdf7;
    }

    .batik-page .text-stone-900 {
        color: #173f39;
    }

    .batik-page .text-gold-700 {
        color: #286254;
    }

    .batik-page .text-gold-500 {
        color: #a76e31;
    }

    .batik-page .border-gold-500 {
        border-color: #b17c42;
    }

    .batik-page .border-gold-100 {
        border-color: #e7d8b8;
    }

    .batik-panel {
        border: 1px solid rgba(177, 124, 66, 0.35);
        background-color: rgba(255, 253, 247, 0.96);
        box-shadow: 0 18px 50px rgba(34, 62, 52, 0.12);
    }

    .batik-pattern {
        background-image:
            repeating-linear-gradient(45deg, transparent 0 15px, rgba(234, 207, 147, 0.24) 15px 16px, transparent 16px 31px),
            repeating-linear-gradient(-45deg, transparent 0 15px, rgba(234, 207, 147, 0.2) 15px 16px, transparent 16px 31px);
    }
</style>
