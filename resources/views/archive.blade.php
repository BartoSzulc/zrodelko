
{{--
  Template Name: Aktualnosci
--}}

@php
// $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 12,
//   'paged' => $paged
);
$query = new WP_Query( $args );

@endphp
@extends('layouts.app')

@section('content')

<section class="archive-aktualnosci__main">
    @include('partials.page-header')
    <div class="container">
      <div class="w-full badge text-left py-half lg:py-full text-7xl font-bold"  data-aos="fade-up">
          <h1>{!! the_title() !!}</h1>
      </div>
      @if ($query->have_posts())
      <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-4 mb-half lg:mb-full">
        @while ($query->have_posts())
            @php $query->the_post() @endphp
            <div class="col-span-1 w-full mx-auto bg-white text-center transition-all ease-in-out duration-500 relative  bottom-0 hover:bottom-2.5 hover:shadow-2xl ">
              <div class="blog relative"  data-aos="fade-up">
                <a class="flex flex-col" href="@permalink">
                  @if (has_post_thumbnail())
                  <img class="mx-auto object-cover object-center w-full h-[200px]" src="@thumbnail('full', false)" alt="">
                  @endif 
                  <div class="content p-5 lg:p-5 flex flex-col gap-4">
                    <div class="text-5xl font-semibold my-2.5 lg:my-5">
                      <h2>@title</h2>
                    </div>
                    <div class="inline-flex items-center justify-center">
                      <a href="@permalink" class="btn-primary mt-auto">
                        {{ __('Dowiedz się więcej')}}
                      </a>
                    </div>
                  </div>
                </a>
              </div>
            </div>
        @endwhile 
      </div>
      @php wp_reset_postdata() @endphp
      @endif
    </div>
  </section>
 
@endsection


