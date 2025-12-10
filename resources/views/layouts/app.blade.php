<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Opsi 4: Custom CSS dari public/css -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        
        <!-- Global Product Image Zoom Effect -->
        <style>
            .product-image-zoom {
                overflow: hidden;
            }
            .product-image-zoom img {
                transition: transform 0.5s ease;
            }
            .product-image-zoom:hover img {
                transform: scale(1.15);
            }
            /* For seller page table images */
            td img {
                transition: transform 0.3s ease;
            }
            td:hover img {
                transform: scale(1.1);
            }
        </style>
        
        <!-- Auto-hide flash messages & Navbar scroll effect -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-hide flash messages
                setTimeout(function() {
                    const alerts = document.querySelectorAll('[role="alert"]');
                    alerts.forEach(function(alert) {
                        alert.style.transition = 'opacity 0.5s';
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    });
                }, 3000);
                
                // Navbar scroll effect & hide search section
                const navbar = document.getElementById('navbar');
                const searchSection = document.getElementById('search-section');
                
                if (navbar) {
                    window.addEventListener('scroll', function() {
                        // Hide search section lebih awal (sebelum navbar berubah)
                        if (window.scrollY > 20) {
                            if (searchSection) {
                                searchSection.style.opacity = '0';
                                searchSection.style.transform = 'translateY(-30px)';
                                searchSection.style.pointerEvents = 'none';
                            }
                        } else {
                            if (searchSection) {
                                searchSection.style.opacity = '1';
                                searchSection.style.transform = 'translateY(0)';
                                searchSection.style.pointerEvents = 'auto';
                            }
                        }
                        
                        // Navbar berubah opacity setelah scroll
                        if (window.scrollY > 80) {
                            navbar.style.opacity = '1';
                            navbar.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
                        } else {
                            navbar.style.opacity = '0.95';
                            navbar.style.boxShadow = 'none';
                        }
                    });
                }
            });
        </script>
    </head>
    <body class="font-sans antialiased" style="background: white; min-height: 100vh;">
        <div class="min-h-screen" style="padding-top: 64px; background: white;">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg fade-in" role="alert">
                            <p class="font-semibold">✓ {{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg fade-in" role="alert">
                            <p class="font-semibold">✗ {{ session('error') }}</p>
                        </div>
                    </div>
                @endif
                
                @if(session('info'))
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded shadow-lg fade-in" role="alert">
                            <p class="font-semibold">ℹ {{ session('info') }}</p>
                        </div>
                    </div>
                @endif
                
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer style="background: #1a1a1a; color: white; padding: 3rem 0 2rem 0; margin-top: 4rem;">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <!-- Logo/Brand -->
                    <div style="margin-bottom: 1rem;">
                        <h2 style="font-size: 2.5rem; font-weight: 900; letter-spacing: 0.05em; font-family: 'Arial Black', sans-serif; line-height: 1; margin-bottom: 0.5rem;">DK</h2>
                        <p style="font-size: 0.9rem; font-weight: 600; letter-spacing: 0.3em; font-family: 'Arial', sans-serif; margin-bottom: 0.5rem;">SUPPLY CO.</p>
                    </div>
                    
                    <!-- Established Text -->
                    <p style="font-size: 0.875rem; color: #9ca3af; margin-bottom: 1.5rem;">{{ __('app.established_by') }}</p>
                    
                    <!-- Divider -->
                    <div style="border-top: 1px solid #374151; margin: 1.5rem auto; max-width: 200px;"></div>
                    
                    <!-- Copyright -->
                    <p style="font-size: 0.75rem; color: #6b7280;">© {{ date('Y') }} DK Supply Co. {{ __('app.all_rights_reserved') }}</p>
                </div>
            </footer>
        </div>
    </body>
</html>
