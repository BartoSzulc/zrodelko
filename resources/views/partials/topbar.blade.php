
@php
    $topbar = $header['topbar'] ?? null;
    $topbar_content = $header['topbar_content'] ?? null;
@endphp

@if (!empty($topbar) && $topbar == 1)
    <section class="topbar bg-black border-b border-gray-dark text-white py-2.5 text-center text-base | md:text-desc">
        <div class="container relative">
            <p>{!! $topbar_content  !!}</p>
        </div>
    </section>
@endif
