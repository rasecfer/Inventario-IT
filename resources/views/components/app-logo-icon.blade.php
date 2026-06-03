{{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 42" {{ $attributes }}>
    <path 
        fill="currentColor" 
        fill-rule="evenodd" 
        clip-rule="evenodd"
        d="M17.2 5.633 8.6.855 0 5.633v26.51l16.2 9 16.2-9v-8.442l7.6-4.223V9.856l-8.6-4.777-8.6 4.777V18.3l-5.6 3.111V5.633ZM38 18.301l-5.6 3.11v-6.157l5.6-3.11V18.3Zm-1.06-7.856-5.54 3.078-5.54-3.079 5.54-3.078 5.54 3.079ZM24.8 18.3v-6.157l5.6 3.111v6.158L24.8 18.3Zm-1 1.732 5.54 3.078-13.14 7.302-5.54-3.078 13.14-7.3v-.002Zm-16.2 7.89 7.6 4.222V38.3L2 30.966V7.92l5.6 3.111v16.892ZM8.6 9.3 3.06 6.222 8.6 3.143l5.54 3.08L8.6 9.3Zm21.8 15.51-13.2 7.334V38.3l13.2-7.334v-6.156ZM9.6 11.034l5.6-3.11v14.6l-5.6 3.11v-14.6Z"
    />
</svg> --}}
<svg width="48" height="48" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
    class="drop-shadow-lg">
    <!-- Outer glow circle -->
    <circle cx="60" cy="60" r="58" stroke="url(#logoGradient)" stroke-width="1.5" fill="none"
        class="animate-pulse-slow" />

    <!-- Server rack background -->
    <rect x="35" y="30" width="50" height="60" rx="4" fill="url(#logoGradient)" opacity="0.2" />
    <rect x="35" y="30" width="50" height="60" rx="4" stroke="url(#logoGradient)" stroke-width="1"
        fill="none" />

    <!-- Server blades -->
    <rect x="40" y="36" width="40" height="12" rx="2" fill="url(#logoGradient)" opacity="0.6" />
    <circle cx="46" cy="42" r="1.5" fill="#ffffff" />
    <circle cx="54" cy="42" r="1.5" fill="#10b981" />
    <rect x="60" y="40" width="16" height="4" rx="1" fill="#ffffff" opacity="0.8" />

    <rect x="40" y="54" width="40" height="12" rx="2" fill="url(#logoGradient)" opacity="0.6" />
    <circle cx="46" cy="60" r="1.5" fill="#ffffff" />
    <circle cx="54" cy="60" r="1.5" fill="#f59e0b" />
    <rect x="60" y="58" width="16" height="4" rx="1" fill="#ffffff" opacity="0.8" />

    <rect x="40" y="72" width="40" height="12" rx="2" fill="url(#logoGradient)" opacity="0.6" />
    <circle cx="46" cy="78" r="1.5" fill="#ffffff" />
    <circle cx="54" cy="78" r="1.5" fill="#3b82f6" />
    <rect x="60" y="76" width="16" height="4" rx="1" fill="#ffffff" opacity="0.8" />

    <!-- Network connection lines (simplified for small size) -->
    <path d="M35 52 L28 52 L28 80 L35 80" stroke="url(#logoGradient)" stroke-width="1" fill="none" opacity="0.5" />
    <circle cx="28" cy="52" r="2" fill="url(#logoGradient)" />
    <circle cx="28" cy="80" r="2" fill="url(#logoGradient)" />

    <!-- WiFi/Network waves (minimal for clarity) -->
    <path d="M88 48 C92 44 96 46 100 52" stroke="url(#logoGradient)" stroke-width="1" fill="none" opacity="0.8" />
    <path d="M90 54 C93 51 96 53 99 58" stroke="url(#logoGradient)" stroke-width="1" fill="none" />

    <!-- Gradients -->
    <defs>
        <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#3b82f6" />
            <stop offset="50%" stop-color="#8b5cf6" />
            <stop offset="100%" stop-color="#06b6d4" />
        </linearGradient>
    </defs>
</svg>
