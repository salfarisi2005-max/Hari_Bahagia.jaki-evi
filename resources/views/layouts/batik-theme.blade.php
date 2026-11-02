<style>
    :root {
        color-scheme: light;
        --page-bg: #f7f2e7;
        --surface: #fffdf7;
        --surface-soft: #efe8d8;
        --deep-surface: #173f39;
        --deep-surface-soft: #27564c;
        --text: #43584f;
        --text-strong: #173f39;
        --text-muted: #748078;
        --border: #e7d8b8;
        --accent: #a76e31;
        --accent-strong: #286254;
        --gold: #b17c42;
        --pattern-opacity: 0.13;
    }

    :root[data-theme="dark"] {
        color-scheme: dark;
        --page-bg: #111c1a;
        --surface: #192724;
        --surface-soft: #20332f;
        --deep-surface: #0b1412;
        --deep-surface-soft: #172522;
        --text: #d3ded7;
        --text-strong: #f5eee0;
        --text-muted: #a5b5ad;
        --border: #3a5049;
        --accent: #e4bd7d;
        --accent-strong: #d2e0d7;
        --gold: #dfbd78;
        --pattern-opacity: 0.17;
    }

    html {
        scroll-behavior: smooth;
    }

    .batik-page {
        position: relative;
        isolation: isolate;
        overflow-x: hidden;
        background-color: var(--page-bg);
        color: var(--text);
        transition: background-color 300ms ease, color 300ms ease;
    }

    .batik-page.bg-stone-50 {
        background-color: var(--page-bg);
    }

    .batik-page.text-stone-800 {
        color: var(--text-strong);
    }

    .batik-page::before {
        position: fixed;
        z-index: -1;
        inset: -48px;
        background-image:
            radial-gradient(ellipse at center, transparent 0 29%, rgba(167, 110, 49, 0.34) 30% 31%, transparent 32%),
            repeating-linear-gradient(45deg, transparent 0 22px, rgba(28, 83, 72, 0.28) 22px 23px, transparent 23px 45px),
            repeating-linear-gradient(-45deg, transparent 0 22px, rgba(165, 111, 50, 0.22) 22px 23px, transparent 23px 45px);
        background-position: 0 0, 0 0, 22px 22px;
        background-size: 46px 46px, 46px 46px, 46px 46px;
        content: "";
        opacity: var(--pattern-opacity);
        pointer-events: none;
        animation: batik-drift 42s linear infinite;
    }

    .batik-page .bg-stone-900 {
        background-color: var(--deep-surface);
    }

    .batik-page .bg-stone-800 {
        background-color: var(--deep-surface-soft);
    }

    .batik-page .bg-stone-100 {
        background-color: var(--surface-soft);
    }

    .batik-page .bg-stone-50 {
        background-color: var(--page-bg);
    }

    .batik-page .bg-white {
        background-color: var(--surface);
    }

    .batik-page .bg-amber-100 {
        background-color: color-mix(in srgb, var(--gold) 20%, var(--surface));
    }

    .batik-page .text-stone-900,
    .batik-page .text-stone-800 {
        color: var(--text-strong);
    }

    .batik-page .text-stone-700,
    .batik-page .text-stone-600 {
        color: var(--text);
    }

    .batik-page .text-stone-500,
    .batik-page .text-stone-400 {
        color: var(--text-muted);
    }

    .batik-page .text-gold-700 {
        color: var(--accent-strong);
    }

    .batik-page .text-gold-500 {
        color: var(--accent);
    }

    .batik-page .text-gold-300 {
        color: var(--gold);
    }

    .batik-page .border-stone-100,
    .batik-page .border-stone-200,
    .batik-page .border-gold-100 {
        border-color: var(--border);
    }

    .batik-page .border-gold-500,
    .batik-page .border-gold-300 {
        border-color: var(--gold);
    }

    .batik-page .batik-panel {
        border: 1px solid color-mix(in srgb, var(--gold) 45%, transparent);
        background-color: color-mix(in srgb, var(--surface) 94%, transparent);
        box-shadow: 0 20px 60px rgba(21, 48, 41, 0.12);
        backdrop-filter: blur(12px);
    }

    :root[data-theme="dark"] .batik-page .batik-panel {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
    }

    .batik-page .batik-pattern {
        background-image:
            radial-gradient(ellipse at center, transparent 0 28%, rgba(234, 207, 147, 0.5) 29% 30%, transparent 31%),
            repeating-linear-gradient(45deg, transparent 0 18px, rgba(234, 207, 147, 0.34) 18px 19px, transparent 19px 37px),
            repeating-linear-gradient(-45deg, transparent 0 18px, rgba(234, 207, 147, 0.28) 18px 19px, transparent 19px 37px);
        background-size: 38px 38px;
        animation: batik-drift 28s linear infinite;
    }

    .batik-page input,
    .batik-page textarea,
    .batik-page select {
        border-color: var(--border);
        background-color: var(--surface);
        color: var(--text-strong);
    }

    .batik-page input::placeholder,
    .batik-page textarea::placeholder {
        color: var(--text-muted);
    }

    .batik-page input:focus,
    .batik-page textarea:focus,
    .batik-page select:focus {
        outline: 2px solid color-mix(in srgb, var(--gold) 55%, transparent);
        outline-offset: 2px;
    }

    .batik-page .wishes-table thead {
        background-color: var(--surface-soft);
        color: var(--text-strong);
    }

    .batik-page .wish-row {
        border-color: var(--border);
    }

    .batik-page .text-red-700 {
        color: #b42318;
    }

    .batik-page .gold-gradient {
        background: linear-gradient(135deg, #bf953f 0%, #fcf6ba 25%, #b38728 50%, #fbf5b7 75%, #aa771c 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .batik-page #btn-open {
        color: #173f39;
    }

    .batik-page .bg-ornament {
        background-image:
            radial-gradient(circle at center, rgba(212, 175, 55, 0.65) 1px, transparent 1.5px),
            radial-gradient(circle at center, rgba(39, 86, 76, 0.28) 1px, transparent 1.5px);
        background-position: 0 0, 12px 12px;
        background-size: 24px 24px;
        opacity: 0.2;
    }

    .batik-page .countdown-card {
        border: 1px solid color-mix(in srgb, var(--gold) 55%, transparent);
        background: color-mix(in srgb, var(--deep-surface-soft) 86%, transparent);
        box-shadow: inset 0 0 24px rgba(255, 255, 255, 0.025);
    }

    @keyframes batik-drift {
        from {
            background-position: 0 0, 0 0, 22px 22px;
        }

        to {
            background-position: 46px 46px, 92px 92px, 114px 114px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        html {
            scroll-behavior: auto;
        }

        .batik-page *,
        .batik-page *::before,
        .batik-page *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            scroll-behavior: auto !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>
