@extends('frontend.layouts.app')

@section('title', 'gallary Page')
@section('meta_description', 'Welcome to our website')
@section('meta_keywords', 'home, laravel, website')

@section('content')
  <!-- GALLERY PAGE -->
  <header class="gallery-hero-sg reveal">
    <div class="gallery-hero-sg-inner">
      <h1>Our <em style="color:var(--gold);font-style:italic;">Gallery</em></h1>
      <p>A glimpse into our state-of-the-art facilities, patient journeys, and advanced medical care.</p>
    </div>
  </header>

  <section class="gallery-wrapper-sg">
    <div class="gallery-grid-sg">
      @foreach($galleries as $index => $gallery)
      <div class="gallery-item-sg reveal {{ $index % 3 == 1 ? 'delay-1' : ($index % 3 == 2 ? 'delay-2' : '') }}" onclick="openImageLightbox(this)">
        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" loading="lazy">
        <div class="gallery-overlay-sg">
          <div class="overlay-content-sg">
            <span>{{ $gallery->subtitle }}</span>
            <h3>{{ $gallery->title }}</h3>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  <!-- IMAGE LIGHTBOX -->
  <div class="image-lightbox-sg" id="imageLightbox">
    <button class="close-lightbox-sg" onclick="closeImageLightbox()">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
    <div class="lightbox-content-sg">
      <img id="lightboxImg" src="" alt="Enlarged Gallery Image">
      <div class="lightbox-caption-sg">
        <span id="lightboxCategory"></span>
        <h3 id="lightboxTitle"></h3>
      </div>
    </div>
  </div>

  <a href="{{ route('frontend.quiz') }}" class="mobile-floating-cta">Get Started &rarr;</a>
@endsection