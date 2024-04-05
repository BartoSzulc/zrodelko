
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
            @include('partials.post')
        @endwhile 
      </div>
      @php wp_reset_postdata() @endphp
      @endif
    </div>
  </section>
 
@endsection


