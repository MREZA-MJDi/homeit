<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials.head')

<body class="min-h-screen bg-slate-100 antialiased">

<div id="app" class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Main Wrapper --}}
    <div class="flex flex-1 flex-col">

        {{-- Navbar --}}
        @include('partials.navbar')

        {{-- Breadcrumb --}}
        @includeWhen(View::exists('partials.breadcrumb'), 'partials.breadcrumb')

        {{-- Main Content --}}
        <main class="flex-1 p-6">

            @yield('content')

        </main>

        {{-- Footer --}}
        @include('partials.footer')

    </div>

</div>

@include('partials.scripts')

</body>

</html>