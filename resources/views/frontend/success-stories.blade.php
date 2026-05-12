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
  <div class="page-body reveal">
    @php
      $categories = $stories->map(function($s) {
          return $s->treatmentType->name ?? 'General';
      })->unique();
    @endphp
    {{-- Sidebar moved to right --}}

    <!-- LEFT FILTER SIDEBAR -->
    <aside class="filter-sidebar">
      <span class="fs-title">Filter Journeys</span>
      <div class="fs-filters">
        <button class="filter-btn story-filter-btn active" data-filter="all"><span class="dot"></span>All Journeys<span
            class="filter-count">{{ $stories->count() }}</span></button>
        @foreach($categories as $cat)
          <button class="filter-btn story-filter-btn" data-filter="{{ Str::slug($cat) }}">
            <span class="dot"></span>{{ $cat }}
            <span class="filter-count">{{ $stories->filter(function($s) use ($cat) { return ($s->treatmentType->name ?? 'General') === $cat; })->count() }}</span>
          </button>
        @endforeach
      </div>
      <hr class="fs-divider">
      <div class="fs-note"><strong>Privacy First.</strong><br>All stories are shared with full informed consent. Names may
        be changed to protect privacy.</div>
      
      <div class="sidebar-cta" style="margin-top: 2rem; background: var(--crimson-light); padding: 1.5rem; border-radius: 12px;">
        <h4 style="font-size: 1rem; color: var(--crimson); margin-bottom: 0.5rem;">Start Your Story</h4>
        <p style="font-size: 0.85rem; color: var(--blue-mid); line-height: 1.4; margin-bottom: 1rem;">Let us help you achieve your dream of parenthood.</p>
        <a href="{{ route('frontend.quiz') }}" style="display: inline-block; color: var(--crimson); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Take Fertility Quiz &rarr;</a>
      </div>
    </aside>

    <!-- RIGHT CONTENT AREA -->
    <div class="story-content-main">
      <!-- Mobile filter toggle -->
      {{-- Mobile filter panel removed to use same vertical list as desktop --}}

      <div class="grid-header reveal">
        <h2>Patient Success Stories</h2>
        <span id="storyVisibleCount">Showing {{ $stories->count() }} stories</span>
      </div>

      <div class="story-page-grid" id="storyPageGrid">
        @foreach($stories as $story)
          <div class="story-page-card reveal"
            data-category="{{ Str::slug($story->treatmentType->name ?? 'General') }}">
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
                <span class="story-page-treatment-tag">{{ $story->treatmentType->name ?? 'Success Story' }}</span>
              </div>
            </div>
          </div>
        @endforeach

        <div class="empty-state" id="storyEmptyState" style="display:none;">
          <h3>No stories found</h3>
          <p>Try selecting a different category.</p>
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
        padding: 2rem 1.5rem;
        gap: 2rem;
      }
      
      /* Hide privacy note and CTA on mobile */
      .fs-divider, 
      .fs-note, 
      .filter-sidebar .sidebar-cta {
        display: none !important;
      }

      .filter-sidebar {
        display: block;
        position: static;
        margin-bottom: 2rem;
      }

      .mobile-filter-panel {
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
      .grid-header h2 {
        font-size: 1.8rem;
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

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const storyFilterBtns = document.querySelectorAll('.story-filter-btn');
      const storyCards = document.querySelectorAll('.story-page-card');
      const storyVisibleCountText = document.getElementById('storyVisibleCount');
      const storyEmptyState = document.getElementById('storyEmptyState');

      function filterStories(category) {
        console.log('Filtering stories by:', category);
        let count = 0;
        
        storyCards.forEach(card => {
          const cardCat = card.getAttribute('data-category');
          // If category is 'all' or matches the card's category
          if (category === 'all' || cardCat === category) {
            card.style.display = 'block';
            count++;
            card.classList.add('reveal');
          } else {
            card.style.display = 'none';
          }
        });

        // Update the display count text
        if (storyVisibleCountText) {
          storyVisibleCountText.textContent = `Showing ${count} ${count === 1 ? 'story' : 'stories'}`;
        }
        
        // Toggle empty state visibility
        if (storyEmptyState) {
          if (count === 0) {
            storyEmptyState.style.display = 'block';
          } else {
            storyEmptyState.style.display = 'none';
          }
        }
      }

      storyFilterBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          storyFilterBtns.forEach(b => b.classList.remove('active'));
          btn.classList.add('active');

          const filter = btn.getAttribute('data-filter');
          filterStories(filter);
        });
      });

      // Initial filter on page load to sync count and visibility
      filterStories('all');
    });
  </script>
@endsection