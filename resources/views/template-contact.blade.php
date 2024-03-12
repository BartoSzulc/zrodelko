{{--
  Template Name: Contact Page
--}}
@php
$contact = get_field('contact-page');
$contact_title = $contact['contact-title'] ?? null;
$contacts = $contact['contact'] ?? null;

@endphp
@extends('layouts.app')

@section('content')
@include('partials.page-header')
@if (!empty($contact))
<section class="contact-page bg-white pb-30 lg:pb-0">
    <div class="container">
        <div class="w-full">
            @if (!empty($contact_title))
            <div class="text-left text-6xl font-bold lg:py-60 py-30">
                <h1>{{ $contact_title }}</h1>
            </div>
            @endif
            @if (!empty($contacts))
            <div class="">
                @php
                        $count = 0;
                    @endphp
                @foreach ($contacts as $item)

                @php
                    $title = $item['contact-title'];
                    $text = $item['contact-text'];
                    $desc = $item['contact-desc'];
                    $url = $item['contact-url'];
                   
                @endphp
                <div class="grid grid-cols-6 gap-4 lg:pb-60 @if ($count>0) mt-5  @endif">
                    <div class="col-span-full sm:col-span-3 lg:col-span-2 @if ($count>0) lg:mt-60 sm:mt-30 @endif">
                        @if (!empty($title))
                        <div class="text-5xl font-bold text-primary pb-2.5">
                            <p>{{ $title }}</p>
                        </div>
                        @endif
                        <div class="text-base leading-10 text-gray font-bold">
                            @if (!empty($text))
                                <p>{{ $text }}</p>
                            @endif
                            @if (!empty($desc))
                                {!! $desc !!}
                            @endif
                        </div>
                    </div>
                    @if (!empty($url))
                    <div class="col-span-full sm:col-span-3 lg:col-span-2 @if ($count>0) lg:mt-60 sm:mt-30 @endif">
                        <iframe src="{{ $url }}" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    @endif
                </div>
                    @php
                        $count++;
                    @endphp
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endif

@endsection