@if ($promo_products) 
<div class="sale-of-the-week mt-30 hidden lg:block">
    <div class="text-6xl font-bold mb-30">
        <h2>Oferta tygodnia</h2>
    </div>
    {!! do_shortcode('[sale_countdown_archive]') !!}
    @if ($promo_products)
    @php
      $args = array(
          'post_type'      => 'product',
          'posts_per_page' => 1,
          'post__in'       => $promo_products,
      );
      $loop = new WP_Query($args);

      if ($loop->have_posts()) {
          while ($loop->have_posts()) {
              $loop->the_post();
              global $product;

              wc_get_template_part('content', 'product');
          }
          wp_reset_postdata(); // Reset the post data after the loop
      }
    @endphp
    @endif
  </div>
@endif
