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
    <div class="gallery-grid-sg" id="galleryGrid">
      @if($galleries->isEmpty())
        <div class="col-12 text-center p-40" style="grid-column: 1 / -1;">
            <p class="text-secondary">No gallery items available at the moment.</p>
        </div>
      @else
        @include('frontend.partials.gallery_cards', ['galleries' => $galleries])
      @endif
    </div>

    <!-- Pagination -> Load More -->
    @if($galleries->hasMorePages())
    <div class="gallery-pagination reveal delay-2" id="galleryLoadMoreContainer" style="display: flex; justify-content: center; margin-top: 4rem;">
        <button class="btn-outline load-more-btn" data-target="galleryGrid" data-container="galleryLoadMoreContainer" data-param="page" data-next-page="{{ $galleries->currentPage() + 1 }}" style="padding: 12px 30px; font-weight: 600; cursor: pointer;">
            Load More Gallery
        </button>
    </div>
    @endif
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