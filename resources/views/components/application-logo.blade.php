<img src="{{ asset('images/dk-logo.svg') }}" 
     alt="DK Supply Co." 
     {{ $attributes->merge(['class' => 'dk-logo']) }}
     style="filter: {{ request()->routeIs('home') ? 'brightness(0) invert(1)' : 'brightness(0) invert(0.2)' }}; transition: filter 0.3s ease;" />
