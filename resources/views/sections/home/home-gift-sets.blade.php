@php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'zestawy-upominkowe',
        ),
    ),
);

$loop = new WP_Query($args);
@endphp

<section class="home-products-gift-sets py-30 lg:py-60 bg-white">
    <div class="container">
        <div class="w-full text-center py-30 lg:mb-60">
            <div class="text-6xl font-bold">
                <h2>{!! __('Zestawy prezentowe') !!}</h2>
            </div>
        </div>
        @if ($loop->have_posts())
        <div class="products grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
            @while ($loop->have_posts())
                @php
                    $loop->the_post();
                    global $product;
                @endphp
                @php
                    wc_get_template_part('content', 'product');
                @endphp
            @endwhile
        </div>
        @endif
        @php
            wp_reset_postdata();
        @endphp 
        <div class="w-full flex items-center justify-center mt-30 lg:mt-60">
            @php
                $term = get_term_by('slug', 'zestawy-upominkowe', 'product_cat');
                $link = get_term_link($term);
                
            @endphp
            <a href="{{ $link }}" class="btn-secondary">{!! __('Zobacz wszystkie') !!}</a>
        </div>
    </div>
</section>