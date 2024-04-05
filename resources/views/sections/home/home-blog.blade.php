@php
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 12,
//   'paged' => $paged
);
$query = new WP_Query( $args );
$page = get_page_by_path('aktualnosci');

@endphp
@if ($query->have_posts())
<section class="home__blog py-half lg:py-full">
  <div class="w-full badge text-center py-30 lg:mb-60 text-6xl font-bold"  data-aos="fade-up">
    <h1>Aktualności</h1>
  </div>
    <div class="container">
       
      <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-4 mb-half lg:mb-full">
        @while ($query->have_posts())
            @php $query->the_post() @endphp
            @include('partials.post')
        @endwhile 
      </div>
      @php wp_reset_postdata() @endphp
      <div class="w-full flex items-center justify-center">
        <a class="btn-secondary" href="{{ get_permalink($page->ID) }}">Zobacz wszystkie</a>

      </div>
    </div>
</section>
@endif
