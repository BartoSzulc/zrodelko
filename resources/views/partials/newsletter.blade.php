
@php

$newsletter = get_field('newsletter', 'option');

$newsletter_title = $newsletter['newsletter_title'] ?? null;
$newsletter_price = $newsletter['newsletter_price'] ?? null;
$newsletter_subtitle = $newsletter['newsletter_subtitle'] ?? null;
$newsletter_shortcode = $newsletter['newsletter_shortcode'] ?? null;

@endphp
@if (!empty($newsletter))
<section class="newsletter bg-gray-light relative lg:pt-[120px] lg:pb-full pt-30 pb-30">
    <div class="container">
        <div class="grid grid-cols-12 gap-4 relative ">
            
            <div class="xl:col-start-2 xl:col-span-10 col-span-full p-half overflow-hidden relative z-10 newsletter-main">
                <img class="newsletter-bg absolute lg:-top-28 top-0 right-0 lg:-right-[350px] object-right z-0 hidden lg:block" src="{{ asset('images/newsletter-bg.png') }}" alt="">
                <div class="absolute newsletter-inside w-full h-full z-10 top-0 right-0"></div>
                <div class="lg:grid grid-cols-2 gap-4 relative z-10">
                    <div class="col-span-1 text-center sm:text-left flex flex-col sm:flex-row items-center justify-center lg:justify-start lg:items-start mb-5 lg:mb-0">
                        <img class="w-20 mb-5" src="{{ asset('images/newsletter-icon.svg') }}" alt="">
                        <div class="text sm:ml-8">
                            @if (!empty($newsletter_title))
                            <div class="text-7xl font-bold mb-4">
                                <h2>{!! $newsletter_title !!}</h2>
                            </div>
                            @endif
                            @if (!empty($newsletter_price))
                            <div class="text-9xl font-headings_sec mb-2.5 text-primary">
                                <p>{!! $newsletter_price !!}</p>
                            </div>
                            @endif
                            @if (!empty($newsletter_subtitle))
                            <div class="text-5xl font-bold">
                               {!! $newsletter_subtitle !!}
                            </div>
                            @endif
                        </div>
                    </div>
                    @if (!empty($newsletter_shortcode))
                    <div class="col-span-1 flex items-center">
                        {!! do_shortcode($newsletter_shortcode) !!}
                    </div>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</section>
@endif