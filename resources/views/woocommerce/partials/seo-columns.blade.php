@php

$category_id = get_queried_object_id();
$category_column = get_field('category_column', 'product_cat_' . $category_id);
$category_column_1 = get_field('category_column_1', 'product_cat_' . $category_id);

$title = $category_column['title'] ?? null;
$content = $category_column['content'] ?? null;

$title_1 = $category_column_1['title'] ?? null;
$content_1 = $category_column_1['content'] ?? null;

@endphp
@if ($category_column || $category_column_1)
<section class="category-seo-section lg:my-60 my-30">
    <div class="container">
        <div class="grid gap-4 lg:grid-cols-2 grid-cols-1">
            @if ($category_column)
            <div class="col-span-1">
                @if ($title)
                <div class="title text-5xl font-bold mb-5 lg:mb-30">
                    {!! $title !!}
                </div>
                @endif
                @if ($content)
                <div class="content text-content text-gray">
                    {!! $content !!}
                </div>
                @endif
            </div>
            @endif
           
            @if ($category_column_1)
            <div class="col-span-1">
                @if ($title_1)
                <div class="title text-5xl font-bold mb-5 lg:mb-30">
                    {!! $title_1 !!}
                </div>
                @endif
                @if ($content_1)
                <div class="content text-content text-gray">
                    {!! $content_1 !!}
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
@endif