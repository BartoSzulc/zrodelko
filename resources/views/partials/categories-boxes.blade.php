@php
$categories = array(
    'whisky',
    'wodki',
    'wina'
);
@endphp
<section class="categories-boxes">
    <div class="container">
        <div class="grid lg:grid-cols-3 grid-cols-1 gap-4">
        @foreach ($categories as $category_slug) 
            @php
            $category = get_term_by('slug', $category_slug, 'product_cat');
            $category_link = get_term_link($category);
            $category_image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $category_image_url = wp_get_attachment_url($category_image_id);
            $category_description = $category->description;
            @endphp
            
            <div class="col-span-1 {{ $category_slug }}">
                <a href="{{ $category_link }}" class="relative group transition-colors">
                    <img class="aspect-[472/380] object-cover h-full w-full object-center " src="{{ $category_image_url }}" alt="{{ $category->name }}">
                    <div class="box w-[calc(100%-25.84%)] absolute bottom-0 h-[100px] flex items-center pl-30 bg-white text-black group-hover:bg-primary group-hover:text-white transition-colors">
                        <div class="text-6xl font-bold">
                            <h2>{!! $category->name !!}</h2>
                        </div>
                    </div>
                </a>              
            </div>
        @endforeach
        </div>
    </div>
</section>

