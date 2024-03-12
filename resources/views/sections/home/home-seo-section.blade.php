
@php
    
$seobox = get_field('seobox');

$seobox_title = $seobox['seobox-title'] ?? null;


$seobox_group_1 = $seobox['seobox-group_1'] ?? null;
$seo_box_1_title = $seobox_group_1['seobox-group_1-title'] ?? null;
$seo_box_1_content  = $seobox_group_1['seobox-group_1-content'] ?? null;

$seobox_group_2 = $seobox['seobox-group_2'] ?? null;
$seo_box_2_title = $seobox_group_2['seobox-group_2-title'] ?? null;
$seo_box_2_content  = $seobox_group_2['seobox-group_2-content'] ?? null;

@endphp

@if ($seobox)
<section class="home-seo-section bg-white lg:pb-60 pb-5">
    <div class="container">
       @if (!empty($seobox_title))
       <div class="w-full relative text-5xl lg:text-6xl font-bold text-center lg:mb-60 pb-5">
            {!! $seobox_title !!}
       </div>
       @endif
       <div class="grid grid-cols-12 gap-x-4">
          <div class="col-span-full lg:col-span-5 3xl:pl-60 lg:pl-30 relative">
             <div class="relative z-10 flex h-full flex-col justify-center">
               @if (!empty($seo_box_1_title))
                <div class="text-6xl lg:text-9xl font-headings_sec lg:mb-60 mb-5">
                     {!! $seo_box_1_title !!}
                </div>
               @endif
               @if (!empty($seo_box_1_content))
                <div class="text-desc lg:text-5xl font-medium">
                     {!! $seo_box_1_content !!}
                </div>
               @endif
             </div>
             <div class="absolute left-0 top-0 bg-gray-light z-0 h-full 3xl:h-auto hidden lg:block">
                <img class="mix-blend-luminosity object-cover h-full 3xl:h-auto 3xl:object-none" src="{{ asset('images/seo-image.png') }}" alt="">
             </div>
          </div>
          <div class="col-span-full lg:col-span-6 lg:col-start-7 lg:py-60 py-5">
            @if (!empty($seo_box_2_title))
             <div class="text-5xl lg:text-6xl font-bold lg:mb-60 mb-5">
               {!! $seo_box_2_title !!}
             </div>
            @endif
            @if (!empty($seo_box_2_content))
             <div class="wysiwyg text-desc lg:text-5xl">
               {!! $seo_box_2_content !!}
               
             </div>
            @endif
          </div>
       </div>
    </div>
</section>
@endif