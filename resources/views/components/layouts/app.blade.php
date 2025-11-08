<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Munir Jaya Abadi - Toko Online Terpercaya' }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Munir Jaya Abadi - Toko online terpercaya dengan berbagai produk berkualitas. Belanja mudah, aman, dan terpercaya dengan pengiriman ke seluruh Indonesia.">
    <meta name="keywords"
        content="munir jaya abadi, toko online, ecommerce, belanja online, produk berkualitas, pengiriman indonesia, jne, tiki, pos indonesia">
    <meta name="author" content="Munir Jaya Abadi">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Munir Jaya Abadi - Toko Online Terpercaya' }}">
    <meta property="og:description"
        content="Munir Jaya Abadi - Toko online terpercaya dengan berbagai produk berkualitas. Belanja mudah, aman, dan terpercaya.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:site_name" content="Munir Jaya Abadi">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $title ?? 'Munir Jaya Abadi - Toko Online Terpercaya' }}">
    <meta name="twitter:description"
        content="Munir Jaya Abadi - Toko online terpercaya dengan berbagai produk berkualitas.">
    <meta name="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Schema.org Markup for Google -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Store",
        "name": "Munir Jaya Abadi",
        "description": "Toko online terpercaya dengan berbagai produk berkualitas",
        "url": "https://munirjayaabadi.sikcb.my.id",
        "logo": "{{ asset('images/logo.png') }}",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "ID",
            "addressLocality": "Indonesia"
        },
        "sameAs": [
            "https://www.facebook.com/munirjayaabadi",
            "https://www.instagram.com/munirjayaabadi"
        ]
    }
    </script>

    <!-- Favicon - Munir Jaya Abadi Logo -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#667eea">

    <script>
        // Set dark mode based on saved preference or system
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
    @stack('meta')
</head>

<body class="bg-slate-200">
    @livewire('partials.navbar')
    <main>
        {{ $slot }}
    </main>
    @livewire('partials.footer')

    {{-- Chatbot Floating Button --}}
    @livewire('chatbot')

    @livewireScripts
    @stack('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>

</html>
