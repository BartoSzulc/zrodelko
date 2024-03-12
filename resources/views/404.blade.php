@extends('layouts.app')

@section('content')
 

  @if (! have_posts())
    <section class="bg-white py-full relative">
      <div class="absolute bg-white rounded-absolute w-full h-full top-0"></div>
      <div class="container relative z-10 flex flex-col items-center justify-center">
        <div class="text-6xl heading lg:mb-half mb-5 font-bold">
          <div class="font-headings_sec text-center font-extrabold text-primary lg:mb-half mb-5">
            <p>404</p>
          </div>
          <h1>Nie znaleziono strony</h1>
        </div>
        <div class="custom-border"><a href="{{ site_url() }}" class="btn-primary">Powrót</a></div>
      </div>
    </section>

  @endif
@endsection