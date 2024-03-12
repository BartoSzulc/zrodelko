@php
    $header = get_field('header', 'option');
    $logotype = $header['header_logo'];
@endphp
<section class="h-screen w-full bg-black text-white" style="height: 100vh;">
    <div class="container h-full flex flex-col items-center justify-center">
        @if ($logotype)
        <a class="link-hover block max-w-max mx-auto lg:mx-0" href="{{ home_url('/') }}">
            {!! wp_get_attachment_image($logotype, 'full', false, array('class' => '', 'loading' => 'lazy')); !!}
        </a>
        @endif
        <div class="mt-30 text-8xl font-bold  text-center">
            <h1>Strona w budowie</h1>
        </div>
        <div class="mt-5 text-5xl font-bold">
            <p>Zapraszamy wkrótce</p>
        </div>
    </div>
    <div class="w-full flex flex-col items-center justify-center text-center">
        <img style="object-fit: contain; height: 400px; " src="http://zrodelkoalkohole.pl/wp-content/uploads/2023/09/SPEKTRUM_-_tablica__JPG_.jpg" alt="" class="">
        <div class="container">
            <div class="text-desc py-2.5 font-bold text-center text-black">
                <p>Projekt współfinansowany ze środków EFRR. Numer umowy o powierzenie gruntu: UDG-SPE.04.2023/106</p>
            </div>
        </div>
    </div>
</section>
