@extends('frontend.layouts.app')

@section('title', 'Success Stories | Dr. Yuvraj Jadeja')
@section('meta_description', 'Real stories of hope and healing. Discover patient journeys and clinical success stories at our fertility clinic.')

@section('content')
  <!-- HERO -->
  <section class="hero_box3 reveal">
    <div class="hero-eyebrow">Success Stories</div>
    <h1>Voices of <em>Hope &amp; Healing</em></h1>
    <p>Every family carries a unique story. These are moments of perseverance, clinical precision, and the profound joy
      of new beginnings.</p>
    <div class="hero-stats">
      <div class="stat"><span class="stat-num">1,200+</span><span class="stat-label">Successful Births</span></div>
      <div class="stat"><span class="stat-num">15 Yrs</span><span class="stat-label">Clinical Experience</span></div>
      <div class="stat"><span class="stat-num">98%</span><span class="stat-label">Patient Satisfaction</span></div>
    </div>
  </section>

  <!-- PAGE BODY -->
  <div class="page-body">
    <!-- LEFT FILTER SIDEBAR -->
    <aside class="filter-sidebar">
      <span class="fs-title">Filter Journeys</span>
      <div class="fs-filters">
        <button class="filter-btn active" data-filter="all"><span class="dot"></span>All Journeys<span
            class="filter-count">{{ $stories->count() }}</span></button>
        @php
          $categories = $stories->pluck('treatment_type')->unique();
        @endphp
        @foreach($categories as $cat)
          <button class="filter-btn" data-filter="{{ strtolower(str_replace(' ', '-', $cat)) }}">
            <span class="dot"></span>{{ $cat }}
            <span class="filter-count">{{ $stories->where('treatment_type', $cat)->count() }}</span>
          </button>
        @endforeach
      </div>
      <hr class="fs-divider">
      <div class="fs-note"><strong>Privacy First.</strong><br>All stories are shared with full informed consent. Names may
        be changed to protect privacy.</div>
    </aside>

    <!-- RIGHT CONTENT AREA -->
    <div class="story-content-main">
      <!-- Mobile filter toggle -->
      <div class="mobile-filter-panel" id="mobileFilterPanel">
        <button class="filter-btn active" data-filter="all"><span class="dot"></span>All</button>
        @foreach($categories as $cat)
          <button class="filter-btn" data-filter="{{ strtolower(str_replace(' ', '-', $cat)) }}"><span
              class="dot"></span>{{ $cat }}</button>
        @endforeach
      </div>

      <div class="grid-header reveal">
        <h2>Patient Stories</h2>
        <span id="visibleCount">Showing {{ $stories->count() }} stories</span>
      </div>

      <div class="story-page-grid" id="storyPageGrid">
        @foreach($stories as $story)
          <article class="story-page-card reveal"
            data-category="{{ strtolower(str_replace(' ', '-', $story->treatment_type)) }}">
            <div class="story-page-video-wrap">
              @if(Str::endsWith($story->video_url, ['.mp4', '.webm', '.ogg']))
                <video autoplay loop muted playsinline class="story-short-video">
                  <source src="{{ $story->video_url }}" type="video/mp4">
                </video>
              @else
                {{-- Append controls=0 to YouTube/Vimeo embeds --}}
                @php
                  $url = $story->video_url;
                  if (str_contains($url, '?')) {
                      if (!str_contains($url, 'controls=')) $url .= '&controls=0';
                  } else {
                      $url .= '?controls=0';
                  }
                  // Force modest branding and no related videos
                  $url .= '&modestbranding=1&rel=0&showinfo=0&iv_load_policy=3';
                @endphp
                <iframe src="{{ $url }}" loading="lazy" allow="autoplay; encrypted-media" allowfullscreen
                  title="{{ $story->title }}"></iframe>
              @endif
              <div class="story-page-overlay">
                <span class="story-page-patient-name">{{ $story->patient_name ?? $story->title }}</span>
                <span class="story-page-treatment-tag">{{ $story->treatment_type }}</span>
              </div>
            </div>
          </article>
        @endforeach

        <div class="empty-state" id="emptyState" style="display:none;">
          <h3>No stories found</h3>
          <p>Try selecting a different category.</p>
        </div>
      </div>
    </div>
  </div>

  <style>
    .page-body {
      max-width: 1300px;
      margin: 0 auto;
      padding: 4rem 2rem;
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 3rem;
    }

    .story-page-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }

    .story-page-card {
      position: relative;
      background: #000;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
      transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .story-page-card:hover {
      transform: translateY(-8px);
    }

    .story-page-video-wrap {
      aspect-ratio: 9/16;
      position: relative;
      width: 100%;
    }

    .story-page-video-wrap iframe,
    .story-short-video {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border: none;
    }

    .story-page-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 50px 20px 20px;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.95));
      color: #fff;
      display: flex;
      flex-direction: column;
      pointer-events: none;
      z-index: 2;
    }

    .story-page-patient-name {
      font-size: 1.1rem;
      font-weight: 600;
      letter-spacing: -0.01em;
    }

    .story-page-treatment-tag {
      font-size: 0.75rem;
      opacity: 0.8;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      margin-top: 4px;
    }

    @media (max-width: 1100px) {
      .page-body {
        grid-template-columns: 1fr;
      }

      .filter-sidebar {
        display: none;
      }

      .story-page-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .story-page-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <!-- TRUST BAND -->
  <!-- <section class="trust-band">
      <div class="trust-inner">
        <div class="trust-item">
          <div class="trust-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" /></svg></div>
          <div class="trust-text"><strong>Ethical Practice</strong><span>No unnecessary procedures</span></div>
        </div>
        <div class="trust-item">
          <div class="trust-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg></div>
          <div class="trust-text"><strong>Patient-First Care</strong><span>Compassionate every step</span></div>
        </div>
      </div>
    </section> -->

  <a href="{{ route('frontend.quiz') }}" class="mobile-floating-cta">Get Started &rarr;</a>
@endsection